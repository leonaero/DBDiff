#!/bin/bash

set -eu

cd "$(dirname "${0}")"

. image

docker build -t "${IMAGE}" .
