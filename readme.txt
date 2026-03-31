=== streamvault ===

Contributors: AppZoic
Tags: custom-background, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready

Requires at least: 4.5
Tested up to: 6.4
Stable tag: 1.0.6
License: GNU General Public License v2 or later
License URI: LICENSE

Theme called streamvault.

 
Version 1.0.0 – July 19, 2024

- initial release


Version 1.0.1 – July 24, 2024

- Resolved issues with the Order List and balance addition.
- Fixed problems related to job offering, acceptance, and balance addition.
- Introduced a new subscription payment feature.
- Added an Urgent Badge option for jobs.
- Implemented a system to set the minimum amount for the Top Seller badge in theme settings.
- Fixed the Additional Service feature, allowing instant total price changes and add-to-cart functionality.
- Improved site message and general notifications to be dynamic and read upon click.
- Made the Testimonials widget title and star rating dynamic.
- Updated the dashboard's top-right corner dropdown menu, ensuring all URLs are functional.


Version 1.0.2 – July 25, 2024

- Restricted order placement to logged-in users only.
- Fixed issue with the urgent badge in Job Item Style 2.
- Corrected grammar in JavaScript warnings and informational dialogs.
- Updated the "Favorite List" publish badge to include green and yellow colors, and added rating stars.
- Modified Messenger chat style and implemented "ago" time display in JavaScript.

Version 1.0.3 – July 27, 2024

- Added 4 new parameters to `streamvault_pagination`: `$post_query`, `$total_pages`, `$total_items`, and `$items_per_page`.
- Added a Payout page for administrators in the WordPress admin menu.
- Integrated DataTable library for table management.
- Implemented pagination for frontend dashboard items with the pattern `page/([0-9]+)/?$`.
- Enabled pagination on the frontend dashboard for all items, with each page containing a set number of items.
- Updated Yarly pricing plan to use the abbreviation "ya" instead of "mo".
- Enhanced all database query retrieval functions with new arrays and parameters, including the total number of items.

Version 1.0.4 – August 04, 2024

- Added an option to enable or disable Service Auto Approval in the theme settings.
- Added an option to enable or disable Job Auto Approval in the theme settings.
- Fixed an issue where the chat-specific ID was not being fetched.
- Trimmed the last message and message notification strings to 25 characters.
- Added three email templates to the demo.
- Fixed spacing issues and added a close icon ("fal fa-times") to the popup modal.
- Restyled the profile input field for count using Bootstrap classes.

Version 1.0.5 – August 13, 2024

- A commission rate/service fee option has been added to the theme settings.
- The image uploading issue for subscribers from the front-end dashboard has been resolved.

Version 1.0.6 – August 28, 2024

- Corrected and updated the 'Page Integrator Title' for the Signup and Forgot Password forms.
- Fixed the URL for the login page on the Forgot Password screen.
- Removed deprecated and unused options/code from the theme settings for improved performance.
- Deprecated the "Quill" rich text editor as it no longer meets the theme's requirements.
- Integrated the "Summernote" rich text editor to enhance the content writing experience.
- Launched RTL Demo with full import capability.
- Added Arabic translation and included .PO file.

Version 1.0.7 – September 16, 2024

- Fixed license activation warning and deactivated URL display issue.
- Search bar placeholder is now translatable.
- Corrected direction buttons for swiper slider in RTL mode.
- Added custom offer form in chat, similar to Fiverr.

Version 1.0.8 – October 08, 2024

- Added a double-password field to the signup form, allowing users to manually confirm their password during registration.
- Introduced social media login functionality, enabling users to sign up and log in using Google, Facebook, and LinkedIn.
- Added a credentials field to configure social login in the theme settings, introducing a new section titled 'Social Login Settings'.


Version 1.0.9 – November 10, 2024

- Resolved category search issue in the banner.
- Fixed category search issue on the job archive page.
- Added a restricted words chat feature in the theme options and applied it to chats.
- Updated user widget to use a translatable namespace.
- Removed image and video-only restrictions from AJAX file uploads.
- Added freelancer/employer role selection on the registration (signup) page.
- Introduced separate dashboards and menus for freelancers and employers.
- Deprecated the product widget from the core plugin.
- Separated header and footer files from the dashboard and integrated them via hooks.


Version 1.1.0 – December 09, 2024

- After registration, users are now redirected to the profile page on their first visit.  
- Added a control option in the Elementor user widget to select whether the user is displayed as an employer or freelancer.  
- Upon completing the registration form, users are redirected to the login page.  
- If an admin registers a user, the user will be prompted on their first login to choose between becoming an employer or freelancer. Until they make a selection, no options will be visible in their dashboard.  


Version 1.1.1 – December 16, 2024

- Enabled "Delete Account" feature with new code implementation.
- Restyled profile image edit button with rounded corners and fixed live change functionality.
- Fixed issue with the upload file icon, ensuring a meme icon is available for non-image files. 
- The wishlist alert has been changed from "success" to "error" if the item is already in the wishlist.  
- The infinite spinning issue during loading when adding to the wishlist has been fixed.


Version 1.1.2 – January 19, 2025

- Fixed an issue where the service creation and update package was not being created during the process.
- Resolved redirection issues after creating or updating a service.
- Ensured subscription plans cannot be purchased without logging in.


Version 1.1.3 – February 15, 2025

- Fixed pagination number issue by adding dots (…) when there are a large number of pages.


Version 1.1.4 – June 12, 2025

- Gig/Service ratings can now only be submitted by verified clients. Public ratings are restricted and no longer allowed without a completed purchase.
- Regenerated demo with updated image URLs, correcting issues from the previous demo.


Version 1.1.5 – Jan 12, 2026

- Removed the job post button from the header dropdown profile menu; it is now available only for employers
- Added a new menu for freelancers to add gigs/services and view all their gigs
- Fixed the issue with undefined total posts variable
- Tags deprecated from services
- New demo settings exported for the new year
- Added new route restrictions to functions, limiting page access for freelancers and employers


Version 1.1.6 – February 20, 2026

- The password changing issue has been fixed in the user dashboard.
- The social login and registration enable/disable option has been added to the settings.