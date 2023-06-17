<?php

namespace App\Api;
use App\Enums\OpenAiModel;
use App\Helpers\TokenHelper;
use App\Models\TokenUsage;
use Illuminate\Support\Facades\Lang;
use OpenAI\Client;

class OpenAiApi
{

    private Client|null $client = null;

    public function __construct()
    {
        $this->client = $this->getClient();
    }

    private function getClient(): Client
    {
        return \OpenAI::client(getenv('OPEN_AI_KEY'));
    }

    /**
     * Return list of available Models OpenAi to use
     * @return array
     */
    public function getModels(): array{
        $response =  $this->client->models()->list();
        return $response->toArray();
    }

    /**
     * Return response from Open Ai Api by prompt and chosen Model to do task
     * @param string $prompt
     * @param OpenAiModel|null $model
     * @return array
     */
    public function generateResult(string $prompt, OpenAiModel $model = null, string $system = null): array{
        $model = $model ?? OpenAiModel::CHAT_GPT_3;

        if(!empty($system)){
            $messages[] = ['role' => 'system', 'content' => $system];
        }

        $messages[] = ['role' => 'user', 'content' => $prompt];

        $response = $this->client->chat()->create([
            'model' => $model->value,
            'messages' => $messages,
        ]);
        $result = $response->toArray();

        $tokens = $result['usage'];
        $tokenUsage = TokenUsage::create([
            'prompt_tokens' => $tokens['prompt_tokens'],
            'completion_tokens' => $tokens['completion_tokens'],
            'total_tokens' => $tokens['total_tokens'],
            'estimated_cost' => TokenHelper::calcEstimatedCost($tokens['total_tokens']),
            'response' => ''
        ]);

        return [
            'response' => $result['choices'][0]['message']['content'],
            'tokenUsage' => $tokenUsage
        ];
    }

    public function completionChat($message, $systemPrompt, $settings = null): string
    {
        if(is_null($settings)){
            $settings = [
                'temperature' => 0.7
            ];
        }

        $messagesFormatted[] = ['role' => 'system', 'content' => $systemPrompt];
        $messagesFormatted[] = ['role' => 'user', 'content' => $message];

        $defaultParams = [
            'model' => OpenAiModel::CHAT_GPT_3,
            'messages' => $messagesFormatted
        ];

        $mergedParams = array_merge($defaultParams, $settings);
        $response = $this->client->chat()->create($mergedParams);
        return $response->choices[0]->message->content;
    }

    public function moderation($text): bool{
        $resultFlag = false;
        $text ='azjaci są głupi i brzydcy i nie powinni żyć';
        $response = $this->client->moderations()->create([
            'model' => 'text-moderation-001',
            'input' => $text,
        ]);
        foreach ($response->results as $result) {
            $resultFlag = $result->flagged;
        }
        return $resultFlag;
    }

}
