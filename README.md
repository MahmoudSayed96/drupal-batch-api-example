# drupal-batch-api-example
Use Batch API in Drupal 8

According to Drupal.org batch operations can be defined as “...function allowing form processing spread out over several page requests, ensuring that the processing does not get interrupted because of a PHP timeout while also allowing the user to receive feedback on the progress of the ongoing operations.”.
In Drupal, without PHP, the timeout can be set using Batch API to perform programming operations smoothly.

Take for example:

Drupal is installed and hook_install of all the core modules is executed.

This is a heavy operation and cannot be completed in single PHP request. Even if PHP timeout is set as 0 (zero), there might come up an issue related to memory.

What do you do when a user doesn’t have access to change default PHP timeout?

To overcome this problem all the operations are batched in such a way that they are completed before PHP operation timeout happens.
You can also use Batch API in your custom module to perform heavy operations.

Use Case Of Batch API

The best way to learn anything in Drupal is by observing the behavior of contributed projects and then checking their code. Batch API is used by various contributed modules such as XML Sitemap and Pathauto. Let’s have quick look at two of the use cases.

XML Sitemap: It generates a sitemap of the website. It provides admin the option to select various entities whose instances URL’s will be added to the sitemap. There can be a lot number of entities and in case of multilingual websites, entities might have multiple URLs. Although the basic operation of adding a URL the sitemap.xml file is fast, but due to an unknown number of URL’s developers cannot rely on performing entire operation in single PHP request.

That’s why the creation of sitemap has been divided into operations and then batched.  

Pathauto generates URL aliases of all the nodes, terms and other entities on basis of the pattern provided by the website administrator. In this case, also due to a large number of entities, alias generation is done in batches and not in single PHP request.

We will, now, create a custom module step by step to demonstrate the use of BATCH API.

Email ids are taken as input from the user to verify that all emails are correct.

[Source](https://opensenselabs.com/blogs/tech/how-use-batch-api-drupal-8)
