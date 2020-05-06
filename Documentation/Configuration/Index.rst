.. include:: ../Includes.txt


.. _configuration:

=============
Configuration
=============

Target group: **Developers, Integrators**

The extension gets by with very little configuration.
If you want to connect to a custom platform you need to provide the baseUrl to the API and the map.
Otherwise the defaults will suffice and you only need to include the static TypoScript template.


Defaults
===============

settings.map
---------

If you want to embed a map from a custom platform you need to change the baseUrl property, otherwise the standard
WECHANGE map is embeded.

+-----------------------------------+---------------+-----------------------------------------------------------------------+
| Property                          | Data Type     |                                                                       |
+===================================+===============+=======================================================================+
| baseUrl                           | string        | https://wechange.de/                                                  |
+-----------------------------------+---------------+-----------------------------------------------------------------------+

**Example:**

.. code-block:: typoscript

 map {
         baseUrl = https://wechange.de/
     }

settings.api
---------

If you want to query data from a custom API you need to change the baseUrl.

+-----------------------------------+---------------+-----------------------------------------------------------------------+
| Property                          | Data Type     |                                                                       |
+===================================+===============+=======================================================================+
| baseUrl                           | string        | https://wechange.de/api/v2/                                           |
+-----------------------------------+---------------+-----------------------------------------------------------------------+

**Example:**

.. code-block:: typoscript

 api {
         baseUrl = https://wechange.de/api/v2/
     }

.. _configuration-typoscript:
