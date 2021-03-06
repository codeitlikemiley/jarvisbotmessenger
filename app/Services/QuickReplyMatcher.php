<?php

namespace App\Services;

use App\Models\Flow;
use App\Models\Flow\Matcher as MatcherModel;
use App\Models\Recipient;
use Bot\Core\Matcher;
use App\Models\Bot;
use App\Models\Respond;

class QuickReplyMatcher extends RespondMatcher
{
    /**
     * Match input and return respond object.
     *
     * @param Bot $bot
     * @param Recipient $recipient
     * @param string $input
     * @return \Bot\Core\Respond\Respond[]
     * @throws \Exception
     */
    public function match(Bot $bot, Recipient $recipient, $input)
    {
        $input = str_replace('$$QUICKREPLY$$', '', $input);

        try {
            $taxonomy = Respond\Taxonomy::select('responds_taxonomies.*')
                ->leftJoin('responds', 'responds.id', '=', 'responds_taxonomies.respond_id')
                ->where('responds.bot_id', $bot->id)
                ->findOrFail($input);

            $responds = [];

            foreach ($bot->responds()->whereIn('id', $taxonomy->getParamValue('respond', 'array'))->get() as $respond) {
                $responds[] = $this->respond($respond, $recipient);
            }

            return $responds;
        } catch (\Exception $e) {
            logger($e);
        }


        throw new \Exception('Quick reply does not match.');
    }
}
