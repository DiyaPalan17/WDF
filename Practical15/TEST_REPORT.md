# Practical 15 — Test, Security & Accessibility Report

Student: ____________________   Date: ____________________

Mark each item honestly after testing in your local XAMPP setup.

| Test | Result (Pass / Fail / Not tested) | Notes |
|---|---|---|
| Home and navigation | Not tested | |
| Registration | Not tested | |
| Login valid/invalid | Not tested | |
| Dashboard and profile | Not tested | |
| Events AJAX search | Not tested | |
| Logout/session ends | Not tested | |
| Mobile layout | Not tested | |

## Security checklist
- [ ] Passwords use `password_hash()` and `password_verify()`
- [ ] SQL queries use PDO prepared statements
- [ ] Output is escaped with `htmlspecialchars`
- [ ] Forms use CSRF tokens
- [ ] Session ID is regenerated after login
- [ ] Admin-only controls are protected if you add them

## Accessibility checklist
- [ ] Inputs have labels
- [ ] Status updates use accessible live regions
- [ ] Navigation and controls can be used with keyboard
- [ ] Text has readable contrast
- [ ] Responsive layout tested

Issues found and fixes:
- 
