<?php
namespace Mockery
{
/**
 * Render class impl. for autocompletion
 * @see \Mockery\Expectation
 */
interface ExpectationInterface {/**
     * Verify the current call, i.e. that the given arguments match those
     * of this expectation
     *
     * @param array $args
     * @return mixed
     */
public function verifyCall(array $args);
/**
     * Checks if this expectation is eligible for additional calls
     *
     * @return bool
     */
public function isEligible();
/**
     * Check if there is a constraint on call count
     *
     * @return bool
     */
public function isCallCountConstrained();
/**
     * Verify call order
     *
     * @return void
     */
public function validateOrder();
/**
     * Verify this expectation
     *
     * @return void
     */
public function verify();
/**
     * Check if passed arguments match an argument expectation
     *
     * @param array $args
     * @return bool
     */
public function matchArgs(array $args);
/**
     * Expected argument setter for the expectation
     *
     * @param mixed ...$args
     *
     * @return \Mockery\ExpectationInterface
     */
public function with(...$args);
/**
     * Expected arguments for the expectation passed as an array or a closure that matches each passed argument on
     * each function call.
     *
     * @param array|Closure $argsOrClosure
     * @return \Mockery\ExpectationInterface
     */
public function withArgs($argsOrClosure);
/**
     * Set with() as no arguments expected
     *
     * @return \Mockery\ExpectationInterface
     */
public function withNoArgs();
/**
     * Set expectation that any arguments are acceptable
     *
     * @return \Mockery\ExpectationInterface
     */
public function withAnyArgs();
/**
     * Expected arguments should partially match the real arguments
     *
     * @param mixed ...$expectedArgs
     * @return \Mockery\ExpectationInterface
     */
public function withSomeOfArgs(...$expectedArgs);
/**
     * Set a return value, or sequential queue of return values
     *
     * @param mixed ...$args
     * @return \Mockery\ExpectationInterface
     */
public function andReturn(...$args);
/**
     * Set a return value, or sequential queue of return values
     *
     * @param mixed ...$args
     * @return \Mockery\ExpectationInterface
     */
public function andReturns(...$args);
/**
     * Return this mock, like a fluent interface
     *
     * @return \Mockery\ExpectationInterface
     */
public function andReturnSelf();
/**
     * Set a sequential queue of return values with an array
     *
     * @param array $values
     * @return \Mockery\ExpectationInterface
     */
public function andReturnValues(array $values);
/**
     * Set a closure or sequence of closures with which to generate return
     * values. The arguments passed to the expected method are passed to the
     * closures as parameters.
     *
     * @param callable ...$args
     * @return \Mockery\ExpectationInterface
     */
public function andReturnUsing(...$args);
/**
     * Sets up a closure to return the nth argument from the expected method call
     *
     * @param int $index
     * @return \Mockery\ExpectationInterface
     */
public function andReturnArg($index);
/**
     * Return a self-returning black hole object.
     *
     * @return \Mockery\ExpectationInterface
     */
public function andReturnUndefined();
/**
     * Return null. This is merely a language construct for Mock describing.
     *
     * @return \Mockery\ExpectationInterface
     */
public function andReturnNull();

public function andReturnFalse();

public function andReturnTrue();
/**
     * Set Exception class and arguments to that class to be thrown
     *
     * @param string|\Exception $exception
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     * @return \Mockery\ExpectationInterface
     */
public function andThrow($exception, $message = '', $code = 0, \Exception|null $previous = NULL);

public function andThrows($exception, $message = '', $code = 0, \Exception|null $previous = NULL);
/**
     * Set Exception classes to be thrown
     *
     * @param array $exceptions
     * @return \Mockery\ExpectationInterface
     */
public function andThrowExceptions(array $exceptions);
/**
     * Register values to be set to a public property each time this expectation occurs
     *
     * @param string $name
     * @param array ...$values
     * @return \Mockery\ExpectationInterface
     */
public function andSet($name, ...$values);
/**
     * Sets up a closure that will yield each of the provided args
     *
     * @param mixed ...$args
     * @return \Mockery\ExpectationInterface
     */
public function andYield(...$args);
/**
     * Alias to andSet(). Allows the natural English construct
     * - set('foo', 'bar')->andReturn('bar')
     *
     * @param string $name
     * @param mixed $value
     * @return \Mockery\ExpectationInterface
     */
public function set($name, $value);
/**
     * Indicates this expectation should occur zero or more times
     *
     * @return \Mockery\ExpectationInterface
     */
public function zeroOrMoreTimes();
/**
     * Indicates the number of times this expectation should occur
     *
     * @param int $limit
     * @throws \InvalidArgumentException
     * @return \Mockery\ExpectationInterface
     */
public function times($limit = NULL);
/**
     * Indicates that this expectation is never expected to be called
     *
     * @return \Mockery\ExpectationInterface
     */
public function never();
/**
     * Indicates that this expectation is expected exactly once
     *
     * @return \Mockery\ExpectationInterface
     */
public function once();
/**
     * Indicates that this expectation is expected exactly twice
     *
     * @return \Mockery\ExpectationInterface
     */
public function twice();
/**
     * Sets next count validator to the AtLeast instance
     *
     * @return \Mockery\ExpectationInterface
     */
public function atLeast();
/**
     * Sets next count validator to the AtMost instance
     *
     * @return \Mockery\ExpectationInterface
     */
public function atMost();
/**
     * Shorthand for setting minimum and maximum constraints on call counts
     *
     * @param int $minimum
     * @param int $maximum
     */
public function between($minimum, $maximum);
/**
     * Set the exception message
     *
     * @param string $message
     * @return $this
     */
public function because($message);
/**
     * Indicates that this expectation must be called in a specific given order
     *
     * @param string $group Name of the ordered group
     * @return \Mockery\ExpectationInterface
     */
public function ordered($group = NULL);
/**
     * Indicates call order should apply globally
     *
     * @return \Mockery\ExpectationInterface
     */
public function globally();
/**
     * Return order number
     *
     * @return int
     */
public function getOrderNumber();
/**
     * Mark this expectation as being a default
     *
     * @return \Mockery\ExpectationInterface
     */
public function byDefault();
/**
     * Return the parent mock of the expectation
     *
     * @return \Mockery\LegacyMockInterface|\Mockery\MockInterface
     */
public function getMock();
/**
     * Flag this expectation as calling the original class method with the
     * any provided arguments instead of using a return value queue.
     *
     * @return \Mockery\ExpectationInterface
     */
public function passthru();

public function getName();

public function getExceptionMessage();}
}
