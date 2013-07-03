<?php

namespace FFMpeg\Format\Video;

use FFMpeg\Format\Video\ThreeGP;

class ThreeGPTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ThreeGP
     */
    protected $format;

    protected function setUp()
    {
        $this->format = new ThreeGP();
    }

    /**
     * @covers FFMpeg\Format\Video\ThreeGP::getExtraParams
     */
    public function testGetExtraParams()
    {
        $this->assertEquals(array('-f', '3gp'), $this->format->getExtraParams());
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
     * @covers FFMpeg\Format\Video\ThreeGP::supportBFrames
     */
    public function testSupportBFrames()
    {
        $this->assertFalse($this->format->supportBFrames());
    }
}
