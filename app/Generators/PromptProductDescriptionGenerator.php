<?php

namespace App\Generators;

use App\Generators\Basic\PromptProductDescription;
use App\Services\Decorators\PromptProductDescription\AttributesPromptProductDescriptionDecorator;
use App\Services\Decorators\PromptProductDescription\CategoryPromptProductDescriptionDecorator;
use App\Services\Decorators\PromptProductDescription\DescriptionPromptProductDescriptionDecorator;
use App\Services\Decorators\PromptProductDescription\DistinctiveFeaturesPromptProductDescriptionDecorator;
use App\Services\Decorators\PromptProductDescription\HTMLPromptProductDescriptionDecorator;
use App\Services\Decorators\PromptProductDescription\LimitPromptProductDescriptionDecorator;
use App\Services\Decorators\PromptProductDescription\MaterialPromptProductDescriptionDecorator;
use App\Services\Decorators\PromptProductDescription\ProductNamePromptProductDescriptionDecorator;
use App\Services\Decorators\PromptProductDescription\SeoPromptProductDescriptionDecorator;
use App\Services\Decorators\PromptProductDescription\StylePromptProductDescriptionDecorator;
use App\Services\Decorators\PromptProductDescription\SubjectPromptProductDescriptionDecorator;
use App\Services\Decorators\PromptProductDescription\TargetAudiencePromptProductDescriptionDecorator;
use App\Services\Decorators\PromptProductDescription\TargetPromptProductDescriptionDecorator;
use App\Services\Decorators\PromptProductDescription\UniqueFeaturesPromptProductDescriptionDecorator;
use App\Services\Decorators\PromptProductDescription\WarrantyPromptProductDescriptionDecorator;

class PromptProductDescriptionGenerator
{
    /**
     * Method generates prompt for product description based on received data
     * @param array $data
     * @return string
     */
    public function generate(array $data): string
    {
        $prompt = new PromptProductDescription();

        if (isset($data['subject']) && !empty($data['subject'])) {
            $prompt = new SubjectPromptProductDescriptionDecorator($prompt, $data['subject']);
        }

        if (isset($data['productName']) && !empty($data['productName'])) {
            $prompt = new ProductNamePromptProductDescriptionDecorator($prompt, $data['productName']);
        }

        if (isset($data['category']) && !empty($data['category'])) {
            $prompt = new CategoryPromptProductDescriptionDecorator($prompt, $data['category']);
        }

        $prompt = new TargetPromptProductDescriptionDecorator($prompt);

        if (isset($data['attributes']) && !empty($data['attributes'])) {
            $prompt = new AttributesPromptProductDescriptionDecorator($prompt, $data['attributes']);
        }

        if (isset($data['targetAudience']) && !empty($data['targetAudience'])) {
            $prompt = new TargetAudiencePromptProductDescriptionDecorator($prompt, $data['targetAudience']);
        }

        if (isset($data['keywords']) && !empty($data['keywords'])) {
            $prompt = new DistinctiveFeaturesPromptProductDescriptionDecorator($prompt, $data['keywords']);
        }

        $seoKeywords = isset($data['keywordsSEO']) && !empty($data['keywordsSEO']) !== null ? $data['keywordsSEO'] : null;
        $prompt = new SeoPromptProductDescriptionDecorator($prompt, $seoKeywords);


        if (isset($data['styleAndTone']) && !empty($data['styleAndTone'])) {
            $prompt = new StylePromptProductDescriptionDecorator($prompt, $data['styleAndTone']);
        }

        if (isset($data['limitations']) && !empty($data['limitations'])) {
            $prompt = new LimitPromptProductDescriptionDecorator($prompt, $data['limitations']);
        }

        if (isset($data['material']) && !empty($data['material'])) {
            $prompt = new MaterialPromptProductDescriptionDecorator($prompt, $data['material']);
        }

        if (isset($data['warranty']) && !empty($data['warranty'])) {
            $prompt = new WarrantyPromptProductDescriptionDecorator($prompt, $data['warranty']);
        }

        if (isset($data['uniqueFeatures']) && !empty($data['uniqueFeatures'])) {
            $prompt = new UniqueFeaturesPromptProductDescriptionDecorator($prompt, $data['uniqueFeatures']);
        }

        if (isset($data['description']) && !empty($data['description'])) {
            $prompt = new DescriptionPromptProductDescriptionDecorator($prompt, $data['description']);
        }

        if (isset($data['use_html']) && $data['use_html'] === true) {
            $prompt = new HTMLPromptProductDescriptionDecorator($prompt);
            return $prompt->getPrompt();
        }

        return $prompt->getPrompt();
    }
}
