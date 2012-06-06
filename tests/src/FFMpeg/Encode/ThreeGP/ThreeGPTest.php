<?php

namespace FFMpeg\Encode\ThreeGP;

use FFMpeg\Format\Video\ThreeGP;
use Monolog\Logger;
use Monolog\Handler\NullHandler;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;

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
        // Create a logger
        $logger = new Logger('ffmpeg');

        $logger->pushHandler(new NullHandler());

        $this->ffmpeg = FFMpeg::load($logger);

        $ffprobe = FFProbe::load($logger);

        $this->ffmpeg->setProber($ffprobe);

        $this->input = __DIR__ . '/../../../../ressources/test.mp4';

        $this->output = __DIR__ . '/../../../../output/test.3gp';
    }

    protected function tearDown()
    {
        if(is_file($this->output)) {
            $this->assertGreaterThan(0, filesize($this->output));
            unlink($this->output);
        }
    }

    public function testEncodeBasic()
    {
        try {
            $this->ffmpeg
                ->open($this->input)
                ->encode(new ThreeGP(), $this->output)
                ->close();
        } catch (\FFMpeg\Exception\Exception $e) {
            $this->fail($e->getMessage());
        }
    }

    public function testEncodeOtherCodec()
    {
        $format = new ThreeGP();

        $format->setVideoCodec('h264');
        $format->setAudioCodec('amr');

        try {
            $this->ffmpeg
                ->open($this->input)
                ->encode($format, $this->output)
                ->close();
        } catch (\FFMpeg\Exception\Exception $e) {
            $this->fail($e->getMessage());
        }
    }
}
