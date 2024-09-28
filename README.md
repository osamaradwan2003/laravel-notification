## **Laravel Notification Package**

**Elevate Your Laravel Applications with Customizable and Efficient Notifications**

**Introduction**

The Laravel Notification Package is a powerful and versatile tool designed to streamline and enhance the notification process within your Laravel applications. With its rich features and intuitive API, this package empowers you to create and manage notifications effortlessly, ensuring your users stay informed and engaged.

**Key Features**

* **Extensive Channel Support:** Seamlessly integrate with a wide range of notification channels, including email, SMS, database, Slack, Telegram, and more.
* **Customizable Templates:** Utilize Blade templates to create visually appealing and branded notifications that align with your application's style.
* **Scheduling:** Schedule notifications to be sent at specific times or intervals, automating your communication processes.
* **Internationalization:** Support multiple languages and locales for localized notifications, ensuring a seamless experience for global users.
* **Actionable Notifications:** Enable users to perform actions directly from notifications, such as confirming orders, resetting passwords, or accepting invitations.
* **Group Notifications:** Send notifications to specific groups of users based on their roles, permissions, or other criteria.
* **Notification History:** Track and manage sent notifications for auditing and troubleshooting purposes.

**Installation**

1. **Require the Package:**

   ```bash
   composer require osamaradwan2003/laravel-notification
   ```

2. **Register the Service Provider:**

   Add the service provider to the `providers` array in your `config/app.php` file:

   ```php
   'providers' => [
       // ... other providers
       OsamaRadwan\LaravelNotification\NotificationServiceProvider::class,
   ],
   ```

**Usage**

**Creating Notifications**

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

**Sending Notifications**

```php
$user->notify(new NewOrderNotification($order));
```

**Customizing Channels**

Create custom channels by extending the `Illuminate\Notifications\Channels\Notification` class and implementing the `send` method.

**Additional Features**

* **Notification Mark As Read:** Allow users to mark notifications as read.
* **Notification Preferences:** Enable users to customize their notification preferences.
* **Notification Badges:** Display unread notification counts in your application's interface.

**Contributing**

We welcome contributions to this package! Please refer to the `CONTRIBUTING.md` file for guidelines.

**License**

The Laravel Notification Package is licensed under the MIT License.

**Conclusion**

The Laravel Notification Package offers a comprehensive solution for managing notifications within your Laravel applications. With its flexibility, ease of use, and powerful features, it empowers you to create engaging and informative notifications that enhance the user experience.
