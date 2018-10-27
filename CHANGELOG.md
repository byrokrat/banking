# Changelog

All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## 2.2.0 - 2018-10-27

### Added

- `NordeaEredFormatter` for formatting numbers as done in Nordea eRedovisning

## 2.1.0 - 2018-08-15

### Added

- The `DelegatingFactory` for chaining multiple factories.

### Fixed

- `BankgiroFactory` and `PlusgiroFactory` now supports trimming left side zeros.

## 2.0.0 - 2018-07-07

### Added

- `AccountFactoryInterface`
- Formatters
- `AccountNumber::prettyprint()`

### Changed

- No longer falls back on `Unknown` format when a clearing number matches.
- Bankgiro and PlusGiro accounts can no longer be created through `AccountFactory`.
  Use `BankgiroFactory` and `PlusgiroFactory` instead.
- Smarter rewrites with rewriter combinations.
- Improved error messages when parsing fails.
- Renaming and refactoring throughout the code base.
- Requires php `7.1`.

### Removed

- Preprocessors.

## 1.4.1 - 2018-04-12

### Changed

- Bumped minimum php requirement to `7.0`

### Fixed

- Updated account formats to match latest bgc release: `2017-08-15`

## 1.4.0 - 2017-01-08

### Added

- Now trims left side zeros when parsing account numbers
- `AccountNumber->equals()`
- Preprocessors in `AccountFactory` to enable more complex rewrites

### Deprecated

- `ClearingSeparatorRewriter`, use `NonDigitRemovingRewriter` instead

## 1.3.2 - 2016-12-28

### Changed

- Bumped minimum php requirement to `5.5`

### Fixed

- Updated account formats to match latest bgc release: `2016-10-31`

### Deprecated

- `Formats`, use `FormatFactory` instead

## 1.3.1 - 2016-12-27

### Fixed

- Unknown accounts are no longer created when a format fails due to an unvalid check digit

## 1.3.0 - 2016-12-26

### Added

- Rewrite erroneous raw account numbers or suggest changes in `AccountFactory`

### Changed

- Format nordea personal account numbers as personal id numbers in `getNumber()`

## 1.2.0 - 2016-10-13

### Added

- Support for nordea personal account numbers without clearing number (assuming clearing 3300)

## 1.1.1 - 2016-08-18

### Added

- `.gitattributes` to prevent tests and unneeded files from being included in composer installs

## 1.1.0 - 2016-05-07

### Added

- `PlusgiroFactory` to unambiguously create `PlusGiro` objects
- `BankgiroFactory` to unambiguously create `Bankgiro` objects

## 1.0.1 - 2016-05-04

### Fixed

- Updated account formats to match latest bgc release: `2015-11-13`

## 1.0.0 - 2015-02-11

- Initial release
