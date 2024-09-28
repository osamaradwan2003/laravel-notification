# Laravel Notification Package

## Elevate Your Laravel Applications with Customizable and Efficient Notifications

### Introduction

The Laravel Notification Package simplifies the management of notifications in Laravel applications, enabling developers to create, customize, and deliver notifications efficiently, ensuring users stay informed and engaged.

### Key Features

- **Extensive Channel Support:** Integrate seamlessly with multiple channels such as email, SMS, database, Slack, and Telegram.
- **Customizable Templates:** Create visually appealing notifications using Blade templates to match your application's branding.
- **Scheduling:** Automate your communication by scheduling notifications to be sent at specific times.
- **Internationalization:** Support multiple languages and locales for a global user experience.
- **Actionable Notifications:** Allow users to take actions directly from notifications, enhancing interactivity.
- **Group Notifications:** Send notifications to specific user groups based on roles or other criteria.
- **Notification History:** Keep track of sent notifications for auditing and troubleshooting.

### Installation

1. **Require the Package:**

   ```bash
   composer require osamaradwan2003/laravel-notification
   ```

2. **Register the Service Provider:**

   Add the service provider to the `providers` array in your `config/app.php`:

   ```php
   'providers' => [
       // ... other providers
       OsamaRadwan\LaravelNotification\NotificationServiceProvider::class,
   ],
   ```

### Usage

#### Creating Notifications

```php
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
{
    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Order Received')
            ->line('You have a new order!')
            ->line('Order ID: ' . $this->order->id)
            ->action('View Order', route('orders.show', $this->order->id))
            ->line('Thank you for your order!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'new_order',
            'data' => [
                'order_id' => $this->order->id,
            ],
        ];
    }
}
```

#### Sending Notifications

```php
$user->notify(new NewOrderNotification($order));
```

### Customizing Channels

Create custom channels by extending the `Illuminate\Notifications\Channels\Notification` class and implementing the `send` method to define your notification logic.

### Additional Features

- **Notification Mark as Read:** Allow users to mark notifications as read to keep their inbox organized.
- **Notification Preferences:** Enable users to customize their notification settings based on their preferences.
- **Notification Badges:** Display unread notification counts in your application's interface for better visibility.

### Contributing

We welcome contributions! Please refer to the `CONTRIBUTING.md` file for guidelines on how to contribute to this package.

### License

This package is licensed under the MIT License.

### Conclusion

The Laravel Notification Package provides a comprehensive and flexible solution for managing notifications, enhancing user engagement and improving communication within your Laravel applications. With its ease of use and powerful features, you can create informative notifications that enrich the user experience.
