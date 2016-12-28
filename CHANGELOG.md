# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

- Nothing...

## [1.3.2] - 2016-12-28

### Fixed
- Marked `Formats` as deprecated (in favour of `FormatFactory`)
- Bumped minimum php requirement to `5.5` (due to the use of generators in testsuite)
- Updated account formats to match latest bgc release: `2016-10-31`

## [1.3.1] - 2016-12-27

### Fixed
- Unknown accounts are no longer created when a format fails due to an unvalid check digit

## [1.3.0] - 2016-12-26

### Added
- Rewrite erroneous raw account numbers or suggest changes in `AccountFactory`

### Fixed
- Format nordea personal account numbers as personal id numbers in `getNumber()`

## [1.2.0] - 2016-10-13

### Added
- Support for nordea personal account numbers without clearing number (assuming clearing 3300).

## [1.1.1] - 2016-08-18

### Added
- `.gitattributes` to prevent tests and unneeded files from being included in composer installs.

## [1.1.0] - 2016-05-07

### Added
- `PlusgiroFactory` to unambiguously create `PlusGiro` objects
- `BankgiroFactory` to unambiguously create `Bankgiro` objects

## [1.0.1] - 2016-05-04

### Fixed
- Updated account formats to match latest bgc release: `2015-11-13`

## [1.0.0] - 2015-02-11
- Initial release
