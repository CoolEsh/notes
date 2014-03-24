<div class="container">
    {if ( $application_env === 'production' )}
        <h1>{$this->exception->getMessage()}</h1>
    {else}
        <h1>An error occurred</h1>
        <h2>{$this->message}></h2>
        <h3>Exception information:</h3>
        <p>
            <b>Message:</b> {$this->exception->getMessage()}
        </p>
        <h3>Stack trace:</h3>
        <pre>{$this->exception->getTraceAsString()}</pre>
        <h3>Request Parameters:</h3>
        <pre>{var_dump($this->request->getParams())}</pre>
    {/if}
</div>