<?php

declare(strict_types=1);

namespace Gemini\Data;

use Gemini\Contracts\Arrayable;
use Gemini\Enums\Mode;

/**
 * A predicted FunctionCall returned from the model that contains a string representing the FunctionDeclaration.name with the arguments and their values.
 *
 * https://ai.google.dev/api/caching#FunctionCall
 */
final class FunctionCallingConfig implements Arrayable
{
    /**
     * @param  string  $name  The name of the function to call. Must be a-z, A-Z, 0-9, or contain underscores and dashes, with a maximum length of 63.
     * @param  array<array-key, string>  $args  The function parameters and values to pass to the function.
     */
    public function __construct(
		public Mode $mode,
		public ?array $allowedFunctionNames = null,
    ) {}

    public function toArray(): array
    {
        return [
            'mode' => $this->mode->value,
			'allowedFunctionNames' => $this->allowedFunctionNames,
        ];
    }
}
