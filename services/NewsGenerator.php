<?php

namespace app\services;

use app\models\News;
use app\models\Tag;

class NewsGenerator
{
    /**
     * @param int $number Number of news to be generated
     * @void
     */
    public function generate($number)
    {
        for ($i = 0; $i < $number; $i++) {
            $this->createRandomNews();
        }
    }

    /**
     * @return News
     */
    protected function createRandomNews()
    {
        $news = new News([
            'title' => $this->generateRandomTitle(),
            'text' => $this->generateRandomText(),
        ]);
        $news->save();
        $this->generateTagsForNews($news);

        return $news;
    }

    /**
     * @return Tag
     */
    protected function getRandomTag()
    {
        $availableTags = [
            'hit',
            'politics',
            'culture',
            'technologies',
            'health',
            'music',
            'cinema',
            'climate',
            'science',
            'nature',
            'photography',
            'biology',
        ];

        $i = mt_rand(0, count($availableTags) - 1);

        return $this->ensureTag($availableTags[$i]);
    }

    /**
     * @param string $name
     * @return Tag
     */
    protected function ensureTag($name)
    {
        if ($tag = Tag::find()->where(['name' => $name])->one()) {
            return $tag;
        }

        $tag = new Tag(['name' => $name]);
        $tag->save();

        return $tag;
    }

    /**
     * @param News $news
     * @void
     */
    protected function generateTagsForNews($news)
    {
        $count = mt_rand(1, 5);

        for ($i = 0; $i < $count; $i++) {
            $news->link('tags', $this->getRandomTag());
        }
    }

    protected function generateRandomTitle()
    {
        return 'Lorem ipsum dolor sir emet';
    }

    protected function generateRandomText()
    {
        return str_repeat('Lorem ipsum dolor sir emet.', mt_rand(7, 23));
    }

}
