Installation
============

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require greendot/image-puller-client
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    Greendot\ImagePullerClient\ImagePullerClientBundle::class => ['all' => true],
];
```

### Step 3: Create configuration file

Create configuration file in `config/packages/image-puller-client.yaml`

```yaml
image_puller_client:
  jwt_user: <USER ID>
  jwt_pass: <SECRET>
  src:      <DIR where images are going to be saved>
  endpoint: <URL ENDPOINT>
```

### Step 4: Allow third party routing

Create configuration file in `config/routes/image-puller-client.yaml`

```yaml
image_puller_client:
    resource: '@ImagePullerClientBundle/Resources/config/routes.yaml'
```

Request format:
-----

Send picture as `form-data` with set `jwt-token` in header.