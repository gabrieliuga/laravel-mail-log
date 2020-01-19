<?php

namespace Giuga\LaravelMailLog\Policies;

use Giuga\LaravelMailLog\Models\MailLog;
use Illuminate\Auth\Access\HandlesAuthorization;

class MailLogPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create($user = null, MailLog $formSubmission = null)
    {
        return false;
    }

    public function delete()
    {
        return true;
    }

    public function view()
    {
        return true;
    }
}
