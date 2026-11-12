# Security and limitations

This repository is an **academic prototype**, not a production-ready service. Do not expose it on a public server until the remaining issues have been addressed.

## Improvements in the published source

- Removed local `.env` files and an embedded `.git` directory from the recovered archive.
- Replaced sensitive example environment values with empty placeholders.
- Removed account-specific Firebase configuration from the archived Laravel/Inertia frontend.
- Changed the API password reset endpoint to require a valid Laravel password reset token.
- Added Sanctum token protection to the personal item and collection endpoints.
- Added ownership checks for item and collection operations.
- Hidden the user's password hash from API serialization.
- Separated the complete Quasar frontend from the Laravel backend.

## Remaining limitations

- The repository has not been integration-tested against a running MySQL database since recovery.
- Automated tests from the original archive may need updates for the token-protected API.
- The older Laravel/Inertia UI and its Firebase integration are preserved as reference code, but have not been validated with the separated Quasar application.
- File uploads and base64 image storage need size/type validation and resource limits.
- Token storage in browser localStorage is a prototype choice; a production application should perform a dedicated session and threat-model review.
- Authentication, account recovery, CORS, rate limiting, authorization and error responses require a complete production review.
- The existing Quasar and Laravel dependencies should be audited and upgraded before public deployment.
- Email delivery must be configured for real password-recovery emails; the example backend configuration uses local log output.
- Sample media and reference spreadsheets from the archive were deliberately excluded; add only media that you own or are licensed to redistribute.

## Reporting vulnerabilities

Please avoid posting credentials, personal data or exploit details in public issues. Use private contact channels for sensitive reports.
