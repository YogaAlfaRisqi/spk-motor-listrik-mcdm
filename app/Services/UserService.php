class UserService
{
    protected string $baseUrl = 'http://localhost:8000/api/users';
    public function __construct()
    {
        $this->baseUrl = config('services.api.url');
    }

    public function getAllUsers()
    {
        $response = Http::get($this->baseUrl);
        return $response->json();
    }
}