<?php

namespace Cysha\Casino\Tests\Cards;

use Cysha\Casino\Cards\Card;
use Cysha\Casino\Cards\Deck;
use Cysha\Casino\Cards\Providers\EmptyDeck;

class DeckTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    /** @test **/
    public function can_create_a_deck()
    {
        $deck = new Deck();

        $this->assertEquals(52, $deck->count());
    }

    /** @test **/
    public function can_draw_a_card()
    {
        $deck = new Deck();
        $card = $deck->draw();

        $this->assertInstanceOf(Card::class, $card);
        $this->assertEquals(51, $deck->count());
        $this->assertEquals(1, $deck->countDrawn());
    }

    /**
     * @expectedException UnderflowException
     * @test
     */
    public function cant_draw_a_card_from_empty_deck()
    {
        $deck = new Deck(new EmptyDeck());
        $deck->draw();
    }

    /** @test **/
    public function can_draw_a_hand()
    {
        $deck = new Deck();

        $hand = $deck->drawHand();
        $this->assertCount(1, $hand);

        $hand = $deck->drawHand(10);
        $this->assertCount(10, $hand);
    }

    /** @test **/
    public function can_shuffle_deck()
    {
        $deck = new Deck();

        $this->assertEquals($deck->shuffle(), $deck->shuffle(), '', 0.0, 10, true);
    }

    /** @test **/
    public function can_reset_deck()
    {
        $deck = new Deck();
        $deck->drawHand(2);

        $this->assertCount(50, $deck->getCards());
        $this->assertCount(2, $deck->getDrawnCards());

        $deck->reset();

        $this->assertCount(52, $deck->getCards());
        $this->assertCount(0, $deck->getDrawnCards());
    }
}
