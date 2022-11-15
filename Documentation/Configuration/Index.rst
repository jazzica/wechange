.. include:: ../Includes.txt


.. _configuration:

=============
Configuration
=============

Target group: **Developers, Integrators**

The extension gets by with very little configuration. As of now you may

*  connect to a custom platform
*  change the default map section

For most cases the defaults will suffice and you only need to include the static TypoScript template.

ExtensionConfiguration
======================

ext_conf_template.txt
---------------------

If you want to query a different API you need to change the baseUrl property.

+-----------------------------------+---------------+-----------------------------------------------------------------------+
| Property                          | Data Type     |                                                                       |
+===================================+===============+=======================================================================+
| baseUrl                           | string        | https://wechange.de/api/v2/                                           |
+-----------------------------------+---------------+-----------------------------------------------------------------------+

TypoScript
==========

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

      coordinates {
         ...
      }
 }

settings.map.coordinates
------------------------

The default map section displays the whole of germany.
If you want to change the map section override the default map corners. neLat & neLon represent the upper right corner,
swLat & swLon the bottom left corner.

+-----------------------------------+---------------+-----------------------------------------------------------------------+
| Property                          | Data Type     |                                                                       |
+===================================+===============+=======================================================================+
| neLat                             | string        | 50.66519                                                              |
+-----------------------------------+---------------+-----------------------------------------------------------------------+
| neLon                             | string        | 21.70898                                                              |
+-----------------------------------+---------------+-----------------------------------------------------------------------+
| swLat                             | string        | 50.47554                                                              |
+-----------------------------------+---------------+-----------------------------------------------------------------------+
| swLon                             | string        | -2.19727                                                              |
+-----------------------------------+---------------+-----------------------------------------------------------------------+

**Example:**

.. code-block:: typoscript

 map {
      coordinates {
             neLat = 50.66519
             neLon = 21.70898
             swLat = 50.47554
             swLon = -2.19727
      }
 }

.. _configuration-typoscript:
