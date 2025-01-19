<!-- 
namespace App\Services;

use App\Interfaces\IPaymentRepository;
use Exception;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentService
{
    private $paymentRepository;

    public function __construct(IPaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function processPayment(array $data)
    {
        Stripe::setApiKey(config('stripe.secret'));

        // Create Stripe Charge
        $charge = Charge::create([
            'amount' => $data['amount'] * 100, // Stripe requires amount in cents
            'currency' => 'usd',
            'source' => $data['token'],
            'description' => 'Carbon Credit Purchase',
        ]);

        // Store Order in DB
        $order = $this->paymentRepository->createOrder([
            'user_ID' => $data['user_ID'],
            'total_amount' => $data['amount'],
            'status' => 'completed',
            'country' => $data['country'],
            'company' => $data['company'],
            'address' => $data['address'],
        ]);

        // Store Transaction in DB
        $this->paymentRepository->createTransaction([
            'order_ID' => $order->id,
            'amount' => $data['amount'],
            'payment_method' => $data['payment_method'],
            'status' => 'success',
            'transaction_date' => now(),
        ]);

        return $order;
    }
} --> -->
