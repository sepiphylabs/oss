## Requirements

- PHP ^7.1.3

## Installation

Install the `sericode/oss` package globally via composer.

```bash
composer global require `sericode/oss`
```

Export the global composer bin directory to the `PATH` environment variable.

```bash
export PATH="$PATH:$HOME/.composer/vendor/bin"
```

Ensure that the installation completed successfully.

```bash
oss --version
```

## Usage

Create your oss package by running the command below.

```bash
oss init /path/to/expdir
```
