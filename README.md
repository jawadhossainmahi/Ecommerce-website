# Setting up Local Development Environment

1. Update BASE_URL in `.env` File

   Open the `.env` file located in the root directory of your project. Find the `BASE_URL` variable and update its value to your local environment URL. For example:

   ```
   BASE_URL=http://localhost:8000/
   ```

2. Update BASE_URL in `public/env.js`

   Next, navigate to the `public` directory and open the `env.js` file. Locate the `BASE_URL` variable and set its value to your local environment URL. For example:

   ```javascript
   const BASE_URL = 'http://localhost:8000/';
   ```

3. Update .htaccess File for Development

   In the `public` directory, find the `.htaccess` file and make the following changes:

   - Uncomment the Development rules section.
   - Comment out the Production rules section.

   The updated `.htaccess` file should look like this:

   ```apacheconf
    # DEVELOPMENT RULES
    RewriteCond %{HTTP_HOST} !^www\. [NC]
    RewriteRule ^(.*)$ http://localhost:8000/$1 [L,R=301]
    
    # Ensure https
    RewriteCond %{HTTP:X-Forwarded-Proto} !https
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ http://localhost:8000/$1 [L,R=301]

    # PRODUCTION RULES
    # # Ensure www.
    # RewriteCond %{HTTP_HOST} !^www\. [NC]
    # RewriteRule ^(.*)$ https://www.livshem.se/$1 [L,R=301]

    # # Ensure https
    # RewriteCond %{HTTP:X-Forwarded-Proto} !https
    # RewriteCond %{HTTPS} off
    # RewriteRule ^(.*)$ https://www.livshem.se/$1 [L,R=301]
   ```
