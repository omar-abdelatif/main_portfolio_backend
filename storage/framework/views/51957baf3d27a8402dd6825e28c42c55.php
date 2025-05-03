<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background-color: #2d3748;
            padding: 20px;
            text-align: center;
        }
        .email-header img {
            max-width: 150px;
            height: auto;
        }
        .email-body {
            padding: 30px;
        }
        .email-footer {
            background-color: #f1f5f9;
            padding: 15px;
            text-align: center;
            font-size: 14px;
            color: #64748b;
        }
        h1 {
            color: #2d3748;
            margin-top: 0;
            font-size: 24px;
        }
        .message-info {
            margin-bottom: 25px;
        }
        .message-field {
            margin-bottom: 15px;
        }
        .field-label {
            font-weight: 600;
            color: #4a5568;
            display: block;
            margin-bottom: 5px;
        }
        .field-value {
            background-color: #f8fafc;
            padding: 10px;
            border-radius: 4px;
            border-left: 3px solid #3182ce;
        }
        .message-content {
            background-color: #f8fafc;
            padding: 15px;
            border-radius: 4px;
            border-left: 3px solid #3182ce;
            margin-top: 10px;
            white-space: pre-line;
        }
        .social-links {
            margin-top: 20px;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #3182ce;
            text-decoration: none;
        }
        .cta-button {
            display: inline-block;
            background-color: #3182ce;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin-top: 15px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-header">
            <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="Logo">
        </div>
        <div class="email-body">
            <h1>New Contact Request</h1>
            <p>You have received a new message from your website contact form.</p>

            <div class="message-info">
                <div class="message-field">
                    <span class="field-label">Name:</span>
                    <div class="field-value"><?php echo e($data['name'] ?? 'غير متوفر'); ?></div>
                </div>

                <div class="message-field">
                    <span class="field-label">Email:</span>
                    <div class="field-value"><?php echo e($data['email'] ?? 'غير متوفر'); ?></div>
                </div>

                <?php if(isset($data['phone'])): ?>
                <div class="message-field">
                    <span class="field-label">Phone:</span>
                    <div class="field-value"><?php echo e($data['phone'] ?? 'غير متوفر'); ?></div>
                </div>
                <?php endif; ?>

                <?php if(isset($data['subject'])): ?>
                <div class="message-field">
                    <span class="field-label">Subject:</span>
                    <div class="field-value"><?php echo e($data['subject'] ?? 'غير متوفر'); ?></div>
                </div>
                <?php endif; ?>

                <div class="message-field">
                    <span class="field-label">Message:</span>
                    <div class="message-content"><?php echo e($data['message'] ?? 'غير متوفر'); ?></div>
                </div>

                <div class="message-field">
                    <span class="field-label">Sent on:</span>
                    <div class="field-value"><?php echo e(\Carbon\Carbon::now()->translatedFormat('j F Y - g:i A')); ?></div>
                </div>
            </div>

            <p>You can reply directly to this email to respond to <?php echo e($data['name']); ?>.</p>

            <a href="mailto:<?php echo e($data['email']); ?>" class="cta-button">Reply Now</a>
        </div>
        <div class="email-footer">
            <p>&copy; <?php echo e(date('Y')); ?> Your Web Development Portfolio. All rights reserved.</p>
            <div class="social-links">
                <a href="https://github.com/your-github" target="_blank">GitHub</a>
                <a href="https://linkedin.com/in/your-linkedin" target="_blank">LinkedIn</a>
                <a href="https://twitter.com/your-twitter" target="_blank">Twitter</a>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH D:\html-css-js\Laravel-Projects\Not_Yet\portfolio\resources\views/pages/emails/contact.blade.php ENDPATH**/ ?>