<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\Tokenizer;

class TokenizerTest extends TestCase
{
    /**
     * Check if object is instantiated with no parameters.
     *
     * @test
     */
    public function instantiate_token_with_no_params_test()
    {
        $testedToken = new Tokenizer();
        $this->assertEquals('App\Services\Tokenizer', get_class($testedToken));
    }

    /**
     * Check if object is instantiated with one parameter.
     *
     * @test
     */
    public function instantiate_token_with_one_param_test()
    {
        $testedToken = new Tokenizer(1);
        $this->assertEquals('App\Services\Tokenizer', get_class($testedToken));
    }

    /**
     * Check if object is instantiated with all parameters.
     *
     * @test
     */
    public function instantiate_token_with_all_params_test()
    {
        $testedToken = new Tokenizer(1, 'a');
        $this->assertEquals('App\Services\Tokenizer', get_class($testedToken));
    }

    /**
     * Check if token properly store timestamp.
     *
     * @test
     */
    public function stored_timestamp_test()
    {
        $testedToken = new Tokenizer(1000);
        $this->assertEquals(1000, $testedToken->getTimestamp());
    }

    /**
     * Check if token properly store public hash.
     *
     * @test
     */
    public function stored_token_test()
    {
        $token = md5(1000 . env("APP_KEY"));
        $testedToken = new Tokenizer(1000);
        $this->assertEquals($token, $testedToken->getToken());
    }

    /**
     * Check if Tokenizer checks expiration time properly.
     *
     * @test
     */
    public function evaluate_expiration_false_test()
    {
        $timestamp = strtotime('-1 day', time() + 1);;
        $testedToken = new Tokenizer($timestamp);
        $this->assertFalse($testedToken->isExpired());
    }

    /**
     * Check if Tokenizer checks expiration time properly.
     *
     * @test
     */
    public function evaluate_expiration_true_test()
    {
        $timestamp = strtotime('-1 day', time() - 1);;
        $testedToken = new Tokenizer($timestamp);
        $this->assertTrue($testedToken->isExpired());
    }

    /**
     * Check if Tokenizer checks token validity properly.
     *
     * @test
     */
    public function evaluate_token_test()
    {
        $timestamp = time();
        $token = md5($timestamp . env("APP_KEY"));
        $testedToken = new Tokenizer($timestamp, $token);
        $this->assertTrue($testedToken->isValid());
    }

    /**
     * Check if Tokenizer checks token validity properly.
     *
     * @test
     */
    public function evaluate_token_expired_test()
    {
        $timestamp = strtotime('-1 day', time() - 1);;
        $token = md5($timestamp . env("APP_KEY"));
        $testedToken = new Tokenizer($timestamp, $token);
        $this->assertFalse($testedToken->isValid());
    }
}
