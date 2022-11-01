<?php

namespace Drupal\example_multi_user_message\Service;

use Drupal\user\Entity\User;
use phpDocumentor\Reflection\Types\Integer;


/**
 * Class CountPrivateMessages
 *
 * @package Drupal\example_multi_user_message\Service
 */
class CountPrivateMessages {

  /**
   * @return int
   */
  public function numberMessagesUserMaySend() {
    return 25; // Number for prod
  }

  /**
   * @param string $user_id
   *
   * @return int|void
   * @throws \Drupal\Component\Plugin\Exception\InvalidPluginDefinitionException
   * @throws \Drupal\Component\Plugin\Exception\PluginNotFoundException
   */
  public function countPrivateMessagesSent(string $user_id) {
    $entity = \Drupal::entityTypeManager()->getStorage('private_message_thread');
    $query = $entity->getQuery();

    // Get Private Message threads
    $ids = $query
      ->condition('members', $user_id, 'IN')
      ->condition('updated', (time() - (86400 * 1)), '>')
      ->execute();

    $message_threads = $entity->loadMultiple($ids);
    $number_of_messages_user_sent = 0;

    foreach ($message_threads as $message_thread) {
      $message_thread_messages = $message_thread->getMessages();

      foreach ($message_thread_messages as $message_thread_message) {

        // # of users in group besides person posting
        $messages_sent_to_group = count($message_thread->getMembersId()) - 1;

        if ($message_thread_message->getOwnerId() == $user_id) {
          $number_of_messages_user_sent = $messages_sent_to_group + $number_of_messages_user_sent;
        }
      }
    }
    return $number_of_messages_user_sent;
  }
}
