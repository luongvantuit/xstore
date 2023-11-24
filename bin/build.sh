#!/bin/bash
PROJECT_PATH="$(pwd)/$(dirname $0)/.."
docker build -t xstore:0.0.1 --progress=plain $PROJECT_PATH
