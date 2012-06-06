<?php

namespace FFMpeg\Format\Video;

use FFMpeg\Format\Video\ThreeGP;

class ThreeGPTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var ThreeGP
     */
    protected $format;

    protected function setUp()
    {
        $this->format = new ThreeGP();
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::getWidth
     */
    public function testGetWidth()
    {
        $this->assertEquals(176, $this->format->getWidth());
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::setWidth
     */
    public function testSetWidth()
    {
        $this->format->setWidth(1024);
        $this->assertEquals(1024, $this->format->getWidth());
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::getHeight
     */
    public function testGetHeight()
    {
        $this->assertEquals(144, $this->format->getHeight());
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::setHeight
     */
    public function testSetHeight()
    {
        $this->format->setheight(768);
        $this->assertEquals(768, $this->format->getHeight());
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::getKiloBitrate
     */
    public function testGetKiloBitrate()
    {
        $this->assertEquals(240, $this->format->getKiloBitrate());
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::getExtraParams
     */
    public function testGetExtraParams()
    {
        $this->assertEquals('-f 3gp', $this->format->getExtraParams());
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::getAudioSampleRate
     */
    public function testGetAudioSampleRate()
    {
        $this->assertEquals(8000, $this->format->getAudioSampleRate());
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::getComputedDimensions
     */
    public function testGetComputedDimensions()
    {
        $dimension = $this->format->getComputedDimensions(1024, 768);

        $this->assertInstanceOf('FFMpeg\Format\Dimension', $dimension);

        $this->assertEquals(176, $dimension->getWidth());
        $this->assertEquals(144, $dimension->getHeight());
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::getVideoCodec
     */
    public function testGetVideoCodec()
    {
        $this->assertEquals('h263', $this->format->getVideoCodec());
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::getAudioCodec
     */
    public function testGetAudioCodec()
    {
        $this->assertEquals('aac', $this->format->getAudioCodec());
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::getAvailableVideoCodecs
     */
    public function testGetAvailableVideoCodecs()
    {
        $codecs = $this->format->getAvailableVideoCodecs();

        $this->assertTrue(is_array($codecs));

        $this->assertContains('h263', $codecs);
        $this->assertContains('libx264', $codecs);
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::getAvailableAudioCodecs
     */
    public function testGetAvailableAudioCodecs()
    {
        $codecs = $this->format->getAvailableAudioCodecs();

        $this->assertTrue(is_array($codecs));

        $this->assertContains('aac', $codecs);
        $this->assertContains('amr', $codecs);
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::getFrameRate
     */
    public function testGetFrameRate()
    {
        $this->assertEquals(12, $this->format->getFrameRate());
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::setKiloBitrate
     */
    public function testSetKiloBitrate()
    {
        $this->format->setKiloBitrate(768);

        $this->assertEquals(768, $this->format->getKiloBitrate());
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::setAudioSampleRate
     */
    public function testSetAudioSampleRate()
    {
        $this->format->setAudioSampleRate(44100);

        $this->assertEquals(44100, $this->format->getAudioSampleRate());
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::setFrameRate
     */
    public function testSetFrameRate()
    {
        $this->format->setFrameRate(25);

        $this->assertEquals(25, $this->format->getFrameRate());
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::setVideoCodec
     */
    public function testSetVideoCodec()
    {
        $this->format->setVideoCodec('libx264');

        $this->assertEquals('libx264', $this->format->getVideoCodec());
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::setAudioCodec
     */
    public function testSetAudioCodec()
    {
        $this->format->setAudioCodec('amr');

        $this->assertEquals('amr', $this->format->getAudioCodec());
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::setVideoCodec
     * @expectedException \FFMpeg\Exception\InvalidArgumentException
     */
    public function testSetVideoCodecException()
    {
        $this->format->setVideoCodec('unknow');
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::setAudioCodec
     * @expectedException \FFMpeg\Exception\InvalidArgumentException
     */
    public function testSetAudioCodecException()
    {
        $this->format->setAudioCodec('unknow');
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::getGOPSize
     */
    public function testGetGOPSize()
    {
        $this->assertEquals(0, $this->format->getGOPSize());
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::supportBFrames
     */
    public function testSupportBFrames()
    {
        $this->assertFalse($this->format->supportBFrames());
    }
}
