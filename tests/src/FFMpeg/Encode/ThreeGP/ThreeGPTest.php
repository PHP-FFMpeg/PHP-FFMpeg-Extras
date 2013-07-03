<?php

namespace FFMpeg\Encode\ThreeGP;

use FFMpeg\Format\Video\ThreeGP;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\FFMpeg;

class ThreeGPTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @var FFMpeg\FFMpeg
     */
    protected $ffmpeg;

    protected $input;

    protected $output;

    protected function setUp()
    {
        $this->ffmpeg = FFMpeg::create();
        $this->input = __DIR__ . '/../../../../ressources/test.mp4';
        $this->output = __DIR__ . '/../../../../output/test.3gp';
    }

    protected function tearDown()
    {
        if (is_file($this->output)) {
            $this->assertGreaterThan(0, filesize($this->output));
            unlink($this->output);
        }
    }

    public function testEncodeBasic()
    {
        try {
            $video = $this->ffmpeg->open($this->input);
            $video->filters()->resize(new Dimension(128, 96));
            $video->save(new ThreeGP(), $this->output);
        } catch (\FFMpeg\Exception\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testEncodeOtherCodec()
    {
        $format = new ThreeGP();

        $format->setVideoCodec('libx264');
        $format->setAudioCodec('amr');

        try {
            $this->ffmpeg
                ->open($this->input)
                ->save($format, $this->output);
        } catch (\FFMpeg\Exception\Exception $e) {
            $this->fail($e->getMessage());
        }
    }
}
