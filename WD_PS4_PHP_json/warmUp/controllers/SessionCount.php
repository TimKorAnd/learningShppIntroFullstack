<?php

    class SessionCount
    {
        private $msg = '';

        public function sessionDestroy()
        {
            if (isset($_COOKIE[SESSION_NAME])) {
                $_SESSION = [];
                unset($_COOKIE[SESSION_NAME]);
                if (session_destroy()) {
                    $this->msg = 'current session was destroyed.';
                    session_name(SESSION_NAME);
                    if (session_start()) {
                        $this->msg .= ' new session start.';
                    } else {
                        $this->msg .= ' new session not start.';
                    }
                } else {
                    $this->msg = 'smth go wrong, current session was not destroyed';
                }
            }
        }

        public function display()
        {
            echo $this->msg;
        }

    }