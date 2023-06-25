<?php
error_reporting(0);
header('Content-Type: application/json');

/**
 * An abstract base class for building RESTFul APIs.
 */
abstract class RestfulApiLib {
    protected bool $status = true;
    protected array $result = [];
    protected string $description = 'Request received without any problems.';

    /**
     * Initializes the API by handling incoming requests and generating a response.
     */
    public function __construct() {
        $this->init();
        $this->responseBack();
    }

    /**
     * Handles an incoming request.
     *
     * @param array $request The incoming request as an array.
     */
    abstract function onReceiveRequest(array $request): void;

    /**
     * Initializes the API by checking for incoming requests and handling them if present.
     */
    private function init(): void {
        if (!empty($_REQUEST)) {
            $this->onReceiveRequest($_REQUEST);
            return;
        }
        $this->status = false;
        $this->description = 'Request received with empty parameters.';
    }

    /**
     * Generates a JSON response for the API based on its current status and results.
     */
    private function responseBack(): void {
        $response = [
            'status' => $this->status,
            'result' => $this->result,
            'description' => $this->description
        ];
        echo json_encode($response, JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT | JSON_PRETTY_PRINT);
    }

    final function fail(string $description, array $result = array()): void
    {
        $this->status = false;
        $this->result = $result;
        $this->description = $description;
    }

    final function success(array $result, ?string $description = null): void
    {
        $this->status = true;
        $this->result = $result;
        if ($description) $this->description = $description;
    }
}
