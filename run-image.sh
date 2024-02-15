#!/bin/bash

set -eu

cd "$(dirname "${0}")"

. image
docker run -it --rm --network host -v "$(pwd -P)":/app -u "$(id -u):$(id -g)" "${IMAGE}" bash

