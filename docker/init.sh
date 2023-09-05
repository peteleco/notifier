#!/bin/sh
# Bash cheat sheet https://devhints.io/bash
# Color pallete
ATT='\033[0;31m'    # Red - Attention!
NC='\033[0m'        # No Color
OK='\033[0;32m'    # Green
PARENT_PATH=$( cd "$(dirname "${BASH_SOURCE[0]}")" ; pwd -P )
# check if docker is installed
if which docker > /dev/null
    then
        echo "\n ${OK}OK - Docker installed${NC}\n"
    else
        echo -e "\n ${ATT}FAIL - Please, install the docker application.${NC}\n"
        exit 1
fi

# Check if docker is running
if ! docker info > /dev/null 2>&1; then
  echo "${ATT} FAIL - Docker does not seem to be running, run it first and retry.${NC}\n"
  exit 1
fi

# Get group and user id
while getopts g:u: flag
do
    case "${flag}" in
        g) G_ID=${OPTARG};;
        u) U_ID=${OPTARG};;
    esac
done

if [ -z "$G_ID" ]
  then
    echo "\n ${ATT}No group id supplied\n"
    exit 1
fi
if [ -z "$U_ID" ]
  then
    echo "\n ${ATT}No user id supplied\n"
    exit 1
fi

# build the docker machine
docker build -t app:notifier --build-arg DOCKER_GROUP_ID=${G_ID} --build-arg DOCKER_USER_ID=${U_ID} $PARENT_PATH

# Create the symlink to run tests inside the container
if ! ${PARENT_PATH}/../pest > /dev/null 2>&1; then
    ln -s ${PARENT_PATH}/pest.sh ${PARENT_PATH}/../pest
fi

# Create the symlink to interact with container
if ! ${PARENT_PATH}/../interact > /dev/null 2>&1; then
    ln -s ${PARENT_PATH}/interact.sh ${PARENT_PATH}/../interact
fi