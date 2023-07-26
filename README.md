# Navi Sky

## Status of Project
Actively being developed.

## Overview
This is the backend API for an app that allows a registered user to plan a trip by seeing weather conditions along their travel route.

Designed around RESTful API conventions.

## API Docs
https://documenter.getpostman.com/view/28424968/2s946pWnxG

## Stack
Laravel v10.14.1 using Laravel Sanctum for token based auth.

## Notable Design Choices

### Custom API Layer
The API layer allows for the communication with the 3rd party API to be normalized and only the necessary data has to be returned in the final response shape. This layer was designed around an interface pattern to allow for switching out or adding additional 3rd party data sources without having to refactor as much of the code base in the future.

### JsonResources
Enforce a consistent and expandable API response shape.

### FormRequests
Handle the validation of incoming requests against the defined rules.