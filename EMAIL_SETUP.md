# Email Configuration Guide for CRM System

## 🚀 Production Email Setup

### Option 1: Gmail SMTP (Recommended for small projects)

Add these lines to your `.env` file:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="CRM System"
```

**Gmail Setup Steps:**
1. Enable 2-Factor Authentication on your Gmail account
2. Generate an App Password: Google Account → Security → App passwords
3. Use the App Password (not your regular password) in MAIL_PASSWORD

### Option 2: Custom SMTP Server

```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-server.com
MAIL_PORT=587
MAIL_USERNAME=your-email@yourdomain.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="CRM System"
```

### Option 3: Mailgun (Recommended for large projects)

```env
MAIL_MAILER=mailgun
MAILGUN_DOMAIN=your-domain.mailgun.org
MAILGUN_SECRET=your-mailgun-secret
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="CRM System"
```

## 🛠️ Development Email Setup

For development/testing, use the log driver:

```env
MAIL_MAILER=log
MAIL_LOG_CHANNEL=emails
```

This will save all emails to `storage/logs/laravel.log` so you can see the email content and credentials.

## 📧 Email Features

### When Admin Adds a User:
- ✅ User receives email with login credentials
- ✅ Random secure password generated
- ✅ Professional email template

### When Admin Resets Password:
- ✅ User receives email with new password
- ✅ Old password becomes invalid
- ✅ Security notification included

### User Profile Management:
- ✅ Users can change their own passwords
- ✅ Profile information can be updated
- ✅ No email sent for self-changes

## 🔧 Testing Email System

1. **Development Mode**: Check `storage/logs/laravel.log` for email content
2. **Production Mode**: Emails will be sent to actual email addresses
3. **Queue Mode**: For high-volume, enable `MAIL_QUEUE_ENABLED=true`

## 🚨 Important Notes

- **Never use your regular Gmail password** - always use App Passwords
- **Test with log driver first** to verify email content
- **Use queue for production** to avoid blocking the application
- **Set proper FROM address** to avoid spam filters
- **Monitor email delivery** in production

## 📱 Mobile-Friendly Emails

All email templates are responsive and work on:
- ✅ Desktop email clients
- ✅ Mobile devices
- ✅ Webmail (Gmail, Outlook, Yahoo)
- ✅ Dark mode support
