<?php
namespace Test\IO\Text;

use IO\Text\Ltsv;
use PHPUnit_Framework_TestCase;

class LtsvTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProviderForTestEncodeDecode
     */
    public function testEncode($desc, $data)
    {
        $hash = $data['hash'];
        $ltsv = $data['ltsv'];

        $encoded = Ltsv::encode($hash);
        self::assertEquals($ltsv, $encoded, $desc);
    }

    /**
     * @dataProvider dataProviderForTestEncodeDecode
     */
    public function testDecode($desc, $data)
    {
        $hash = $data['hash'];
        $ltsv = $data['ltsv'];

        $decoded = Ltsv::decode($ltsv);
        self::assertEquals($hash, $decoded, $desc);
    }

    public function dataProviderForTestEncodeDecode()
    {
        $dataset = array(
            array('desc' => 'Test #1', array(
                'hash' => array(
                    'hoge' => 'huga',
                ),
                'ltsv' => 'hoge:huga',
            )),
            array('desc' => 'Test #2', array(
                'hash' => array(
                    'hoge' => 'huga',
                    'foo'  => 'bar',
                ),
                'ltsv' => "hoge:huga\tfoo:bar",
            )),
            array('desc' => 'Test #3', array(
                'hash' => array(
                    'hoge' => 'huga',
                    'foo'  => 'foo:bar',
                    'fizz' => 'buzz',
                ),
                'ltsv' => "hoge:huga\tfoo:foo:bar\tfizz:buzz",
            )),
            array('desc' => 'Test #4', array(
                'hash' => array(
                    'hoge', 'huga',
                ),
                'ltsv' => "0:hoge\t1:huga",
            )),
        );
        return $dataset;
    }

    /**
     * @expectedException InvalidArgumentException
     * @dataProvider dataProviderForTestEncodeFail
     * @group fail
     */
    public function testEncodeFail($desc, $data)
    {
        $hash = $data['hash'];

        $encoded = Ltsv::encode($hash);
    }

    public function dataProviderForTestEncodeFail()
    {
        $dataset = array(
            array('desc' => 'Test Fail #1', array(
                'hash' => array(
                    'foo' => array('bar'),
                ),
            )),
            array('desc' => 'Test Fail #2', array(
                'hash' => array(
                    'foo' => new \stdClass,
                ),
            )),
            array('desc' => 'Test Fail #3', array(
                'hash' => array(
                    'foo' => tmpfile(),
                ),
            )),
            array('desc' => 'Test Fail #4 Key empty', array(
                'hash' => array(
                    '' => 'hoge',
                ),
            )),
            array('desc' => 'Test Fail #5 Key contains :', array(
                'hash' => array(
                    'hoge:huga' => 'hoge',
                ),
            )),
        );
        return $dataset;
    }

    /**
     * @expectedException RuntimeException
     */
    public function testDecodeFail()
    {
        $hash = "hoge:huga\tfoo";
        $encoded = Ltsv::decode($hash);
    }
}
