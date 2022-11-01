<?php

namespace Drupal\Tests\example_multi_user_message\Unit;

use Drupal\Tests\UnitTestCase;
use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\example_multi_user_message\Service\CountPrivateMessages;

/**
 * Class UnitTest
 *
 * @package Drupal\Tests\example_multi_user_message\Unit
 *
 * @group example_multi_user_message
 *
 */
class CountPrivateMessagesTest extends UnitTestCase {

  protected $CountPrivateMessages;

  public function setUp(): void {
    $this->CountPrivateMessages = new CountPrivateMessages();
    $container = new ContainerBuilder();
    \Drupal::setContainer($container);
  }

  public function testGetCount() {
    $this->assertEquals(25, $this->CountPrivateMessages->numberMessagesUserMaySend());
  }

  /* TODO: Finish test *
  public function testCountPrivateMessagesSent() {
    $this->assertEquals(0, $this->CountPrivateMessages->countPrivateMessagesSent('132'));
  }
  /* */

  public function tearDown(): void {
    unset($this->CountPrivateMessages);
  }

}
