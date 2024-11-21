<?php

declare(strict_types=1);

namespace Gemini\Data;

use Gemini\Contracts\Arrayable;

/**
 * A datatype containing media that is part of a multi-part Content message.
 */
final class Part implements Arrayable
{
    /**
     * @param  string|null  $text  Inline text.
     * @param  Blob|null  $inlineData  Inline media bytes.
	 * @param  FunctionCall|null  $functionCall  Function call.
     */
    public function __construct(
        public readonly ?string $text = null,
        public readonly ?Blob $inlineData = null,
		public readonly ?FunctionCall $functionCall = null,
		public readonly ?FunctionResponse $functionResponse = null,
    ) {}

    /**
     * @param  array{ text: ?string, inlineData: ?array{ mimeType: string, data: string }, functionCall: ?array{ name: string, args: array<string, mixed>|null }, functionResponse: ?array{ name: string, response: array<string, mixed> } }  $attributes
     */
    public static function from(array $attributes): self
    {
        return new self(
            text: $attributes['text'] ?? null,
            inlineData: isset($attributes['inlineData']) ? Blob::from($attributes['inlineData']) : null,
			functionCall: isset($attributes['functionCall']) ? FunctionCall::from($attributes['functionCall']) : null,
			functionResponse: isset($attributes['functionResponse']) ? FunctionResponse::from($attributes['functionResponse']) : null,
        );
    }

    public function toArray(): array
    {
        $data = [];

        if ($this->text !== null) {
            $data['text'] = $this->text;
        }

        if ($this->inlineData !== null) {
            $data['inlineData'] = $this->inlineData;
        }

		if ($this->functionCall !== null) {
			$data['functionCall'] = $this->functionCall;
		}

		if ($this->functionResponse !== null) {
			$data['functionResponse'] = $this->functionResponse;
		}

        return $data;
    }
}
