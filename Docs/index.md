# BERGWERK Address

bwrk_address is a simple but dynamic TYPO3-Extension which allows address integration in TYPO3 CMS 7.6 LTS.

## Table of contents
* What it does
* Developer guide
 * Configure entry-types
 * Templating
* User guide

## What it does

You are completely free in how many informations you store for one contact and which types of information this is.

By default bwrk_address comes with the following entry-types:

* image
* phone
* fax
* mail
* website
* company
* country
* city
* zip
* street_address
* note
* media_gallery
* downloads

The differences between these types are the possible field values:
 
* fal images
* fal files
* rte
* textfield

In addition every type has it's own template partial, so you are able to render each behaviour separately. 
e.q. render a slider in element media_gallery

## Developer guide

This section of the documentation is directed to TYPO3-Integrator and/or developer who want to improve or understand our extension.

### Configure entry-types

The main entrance point here it the TypoScript file called "Configuration/TypoScript/setup.txt" in which you'll find the basic extension setup.

Each entry type must be defined in "plugin.tx_bwrkaddress.setup.types" and could have the following fields set:
 
| Tables        | Are           | Cool  |
| ------------- |:-------------:| -----:|
| col 3 is      | right-aligned | $1600 |
| col 2 is      | centered      |   $12 |
| zebra stripes | are neat      |    $1 |

### Templating

## User guide
