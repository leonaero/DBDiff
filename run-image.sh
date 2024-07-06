#!/bin/bash

set -eu

cd "$(dirname "${0}")"

CMD="${1:-bash}"
. image
docker run -it --rm --network host -v "$(pwd -P)":/app -u "$(id -u):$(id -g)" "${IMAGE}" "${CMD}"
