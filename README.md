# Email Octopus SDK for Laravel

Email Octopus SDK for Laravel is a PHP API client that allows you to interact with the API provided by Email Octopus.
Using the package you can easily subscribe/unsubscribe users to your newsletter, trigger automations and view various
data about your campaigns.

> [!NOTE]
> This repository contains the code that is most suited to be used with Laravel framework.
> If you want to use the PHP API client in a framework-agnostic way,
> check out the `goran-popovic/email-octopus-php` repository.

## PHP Version Support

- \>= 7.2.5

## Laravel Version Support

- \>= 7.29.0

## Installation

You can install the package via composer:

```bash
composer require goran-popovic/email-octopus-laravel
```

If you wish to publish the config file to `config/email-octopus.php` run:

```bash
php artisan vendor:publish --tag="email-octopus-config"
```

## Getting Started

### API key
Before being able to use the SDK, you would need to create an
<a href="https://help.emailoctopus.com/article/165-how-to-create-and-delete-api-keys" target="_blank">Email Octopus API key</a>.

### .env settings
After creating the key by following the instructions above, edit your `.env` file and add the API key there:

```text
EMAIL_OCTOPUS_API_KEY=YOUR_API_KEY
```

### Facade

Package will register a Facade that you can use in your app to make API calls, just make sure to include it
at the top of the file:

```php
use GoranPopovic\EmailOctopus\Facades\EmailOctopus;
```

### Basic implementation
Then, you can interact with Email Octopus's API like so:

```php
use GoranPopovic\EmailOctopus\Facades\EmailOctopus;

$response = EmailOctopus::lists()->createContact('00000000-0000-0000-0000-000000000000', [
    'email_address' => 'goran.popovic@geoligard.com', // required
    'fields' => [ // optional
        'FirstName' => 'Goran',
        'LastName' => 'Popović',
    ],
    'tags' => [ // optional
        'lead'
    ],
    'status' => 'SUBSCRIBED', // optional
]);

echo $response['status']; // SUBSCRIBED
```

## Configuration

Other available config settings include the ability to set the base URI of the API, timeout and connect timeout.
For most use cases the defaults are just fine, but if you want, you can set those params
in either the config file (`config/email-octopus`) or by using environment variables.

## Usage

This wrapper tends to follow the logic and classification found in the official
<a href="https://emailoctopus.com/api-documentation" target="_blank">Email Octopus API docs.</a>
All the routes, and available params for each route are explained in greater detail in those docs.

All the methods are assigned into 3 main resources:

- [Automation Resource](#automation-resource)
- [Campaign Resource](#campaign-resource)
- [List Resource](#list-resource)

### `Automation` Resource

You can find an ID of the automation you are currently viewing in the dashboard URL,
like so: `https://emailoctopus.com/automations/<automationId>`

#### start(string $automationId, array $params)

```php
EmailOctopus::automations()->start('00000000-0000-0000-0000-000000000000', [ 
    'list_member_id' => '00000000-0000-0000-0000-000000000000', 
]);
```

### `Campaign` Resource

You can find an ID of the campaign you are currently viewing in the dashboard URL,
like so: `https://emailoctopus.com/reports/campaign/<campaignId>`

#### get(string $campaignId)

```php
EmailOctopus::campaigns()->get('00000000-0000-0000-0000-000000000000');
```

#### getAll(array $params = [])

```php
EmailOctopus::campaigns()->getAll([
    'limit' => 1, // optional 
    'page' => 2 // optional 
]);
```

#### getReportSummary(string $campaignId)

```php
EmailOctopus::campaigns()->getReportSummary('00000000-0000-0000-0000-000000000000');
```

#### getReportLinks(string $campaignId)

```php
EmailOctopus::campaigns()->getReportLinks('00000000-0000-0000-0000-000000000000');
```

#### getReportBounced(string $campaignId, array $params)

```php
EmailOctopus::campaigns()->getReportBounced('00000000-0000-0000-0000-000000000000', [
    'limit' => 1 // optional 
]);
```

#### getReportClicked(string $campaignId, array $params)

```php
EmailOctopus::campaigns()->getReportClicked('00000000-0000-0000-0000-000000000000', [
    'limit' => 1 // optional 
]);
```

#### getReportComplained(string $campaignId, array $params)

```php
EmailOctopus::campaigns()->getReportComplained('00000000-0000-0000-0000-000000000000', [
    'limit' => 1 // optional 
]);
```

#### getReportOpened(string $campaignId, array $params)

```php
EmailOctopus::campaigns()->getReportOpened('00000000-0000-0000-0000-000000000000', [
    'limit' => 1 // optional 
]);
```

#### getReportSent(string $campaignId, array $params)

```php
EmailOctopus::campaigns()->getReportSent('00000000-0000-0000-0000-000000000000', [
    'limit' => 1 // optional 
]);
```

#### getReportUnsubscribed(string $campaignId)

```php
EmailOctopus::campaigns()->getReportUnsubscribed('00000000-0000-0000-0000-000000000000');
```

#### getReportNotClicked(string $campaignId, array $params)

```php
EmailOctopus::campaigns()->getReportNotClicked('00000000-0000-0000-0000-000000000000', [
    'limit' => 1 // optional 
]);
```

#### getReportNotOpened(string $campaignId, array $params)

```php
EmailOctopus::campaigns()->getReportNotOpened('00000000-0000-0000-0000-000000000000', [
    'limit' => 1 // optional 
]);
```

### `List` Resource

To find the list ID, go to your Email Octopus dashboard, find the `Lists` tab,
select a list by clicking on its title, and when you open a single list simply go to the `settings` tab
and copy the ID from there. Alternatively, you can find an ID of the list or any other resource
you are currently viewing in the dashboard URL, like so: `https://emailoctopus.com/lists/<listId>`

#### get(string $listId)

```php
EmailOctopus::lists()->get('00000000-0000-0000-0000-000000000000');
```

#### getAll(array $params = [])

```php
EmailOctopus::lists()->getAll([
    'limit' => 1, // optional
    'page' => 2 // optional
]);
```

#### create(array $params)

```php
EmailOctopus::lists()->create([
    'name' => 'Api test'
]);
```

#### update(string $listId, array $params)

```php
EmailOctopus::lists()->update('00000000-0000-0000-0000-000000000000', [
    'name' => 'New name'
]);
```

#### delete(string $listId)

```php
EmailOctopus::lists()->delete('00000000-0000-0000-0000-000000000000');
```

#### getAllTags(string $listId)

```php
EmailOctopus::lists()->getAllTags('00000000-0000-0000-0000-000000000000');
```

#### getContact(string $listId, string $memberId)

```php
EmailOctopus::lists()->getContact(
    '00000000-0000-0000-0000-000000000000', 
    '00000000-0000-0000-0000-000000000000', 
);
```

#### getAllContacts(string $listId, array $params = [])

```php
EmailOctopus::lists()->getAllContacts('00000000-0000-0000-0000-000000000000', [
    'limit' => 1, // optional
    'page' => 2 // optional
]);
```

#### getSubscribedContacts(string $listId, array $params = [])

```php
EmailOctopus::lists()->getSubscribedContacts('00000000-0000-0000-0000-000000000000', [
    'limit' => 1, // optional
    'page' => 2 // optional
]);
```

#### getUnsubscribedContacts(string $listId, array $params = [])

```php
EmailOctopus::lists()->getUnsubscribedContacts('00000000-0000-0000-0000-000000000000', [
    'limit' => 1, // optional
    'page' => 2 // optional
]);
```

#### getContactsByTag(string $listId, string $listTag, array $params = [])

```php
EmailOctopus::lists()->getContactsByTag('00000000-0000-0000-0000-000000000000', 'lead', [
    'limit' => 1
]);
```

#### createContact(string $listId, array $params)

```php
EmailOctopus::lists()->createContact('00000000-0000-0000-0000-000000000000', [
    'email_address' => 'goran.popovic@geoligard.com', // required
    'fields' => [ // optional
        'FirstName' => 'Goran',
        'LastName' => 'Popović',
    ],
    'tags' => [ // optional
        'lead'
    ],
    'status' => 'SUBSCRIBED', // optional
]);
```

#### updateContact(string $listId, string $memberId, array $params)

Note: For member ID you can either use the ID of the list contact that you can find in the URL in the dashboard:
`https://emailoctopus.com/lists/<listId>/contacts/<contactId>`,
or an MD5 hash of the lowercase version of the list contact's email address.

```php
EmailOctopus::lists()->updateContact('00000000-0000-0000-0000-000000000000', md5('goran.popovic@geoligard.com'), [
    'email_address' => 'new_email_address@geoligard.com', // optional
    'fields' => [ // optional
        'FirstName' => 'New name',
        'LastName' => 'New lastname',
    ],
    'tags' => [ // optional
        'vip' => true,
        'lead' => false
    ],
    'status' => 'UNSUBSCRIBED', // optional
]);
```

#### deleteContact(string $listId, string $memberId)

Note: For member ID you can either use the ID of the list contact that you can find in the URL in the dashboard:
`https://emailoctopus.com/lists/<listId>/contacts/<contactId>`,
or an MD5 hash of the lowercase version of the list contact's email address.

```php
EmailOctopus::lists()->deleteContact(
    '00000000-0000-0000-0000-000000000000',
    md5('goran.popovic@geoligard.com')
);
```

#### createField(string $listId, array $params)

```php
EmailOctopus::lists()->createField('00000000-0000-0000-0000-000000000000', [
    'label' => 'What is your hometown?',
    'tag' => 'Hometown',
    'type' => 'TEXT',
    'fallback' => 'Unknown' // optional
]);
```

#### updateField(string $listId, string $listFieldTag, array $params)

```php
EmailOctopus::lists()->updateField('00000000-0000-0000-0000-000000000000', 'Hometown', [
    'label' => 'New label',
    'tag' => 'NewTag',
    'fallback' => 'New fallback' // optional
]);
```

#### deleteField(string $listId, string $listFieldTag)

```php
EmailOctopus::lists()->deleteField('00000000-0000-0000-0000-000000000000', 'NewTag');
```

#### createTag(string $listId, array $params)

```php
EmailOctopus::lists()->createTag('00000000-0000-0000-0000-000000000000', [
    'tag' => 'vip'
]);
```

#### updateTag(string $listId, string $listTag, array $params)

```php
EmailOctopus::lists()->updateTag('00000000-0000-0000-0000-000000000000', 'vip', [
    'tag' => 'New Tag Name'
]);
```

#### deleteTag(string $listId, string $listTag)

```php
EmailOctopus::lists()->deleteTag('00000000-0000-0000-0000-000000000000', 'New Tag Name');
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.
