<?php
    namespace App\Helpers {

        class MenuShower
        {
            private static bool $result;
            private static array $permissions = [];
            public static function getPermission ( $current_route_name ): bool
            {
                if ( empty( self::$permissions ) )
                {
                    self::$permissions = auth()->user()->getPermissionLinks()->toArray();
                }

                if ($current_route_name != 'admin.dashboard')
                {
                    if (auth()->id() != 1)
                    {
                        if (!in_array($current_route_name, self::$permissions))
                        {
                            self::$result = false;
                        }
                        else
                        {
                            self::$result = true;
                        }
                    }
                    else
                    {
                        self::$result = true;
                    }
                }
                else
                {
                    self::$result = true;
                }

                return self::$result;
            }
        }
    }
