<?php

declare(strict_types=1);

use Kauffinger\OnOfficeApi\Actions\Action;
use Kauffinger\OnOfficeApi\Actions\ReadActions\ReadUserAction;
use Kauffinger\OnOfficeApi\Enums\SortOrder;
use Kauffinger\OnOfficeApi\OnOfficeApi;
use Kauffinger\OnOfficeApi\OnOfficeApiRequest;

it('can be retrieved from Action base class', function () {
    $instance = Action::read()->user();
    expect($instance::class)->toBe(ReadUserAction::class);
});

it('will render a suitable action array', function () {
    $action = new ReadUserAction();
    $actionArray = $action
        ->fieldsToRead('Anrede', 'Titel', 'Kuerzel')
        ->addSortBy('Anrede', SortOrder::Ascending)
        ->setListLimit(200)
        ->render();

    expect($actionArray['parameters'])->toHaveKeys(['listlimit', 'data', 'sortby']);
    expect($actionArray['parameters']['listlimit'])->toBe(200);
    expect($actionArray['parameters']['sortby'])->toMatchArray(['Anrede' => SortOrder::Ascending->value]);
    expect($actionArray['parameters']['data'])->toMatchArray(['Anrede', 'Titel', 'Kuerzel']);
});

it('will send a successful request', function () {
    $api = new OnOfficeApi(config('onoffice.token'), config('onoffice.secret'));
    $request = new OnOfficeApiRequest();
    $request->addAction(
        Action::read()
            ->user()
            ->fieldsToRead('Anrede', 'Titel', 'Kuerzel')
            ->addSortBy('Anrede', SortOrder::Ascending)
            ->setListLimit(200)
    );

    $response = $api->send($request);
    expect($response->collect()->get('status')['code'])->toBe(200);
});
