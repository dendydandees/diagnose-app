<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\Expert;
use App\Models\Team;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('Gemscool88'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name.'\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }

    /**
     * Indicate that the user should have a user profile.
     *
     * @return $this
     */
    public function withUserProfile()
    {
        return $this->has(
            UserProfile::factory()
                ->state(function (array $attributes, User $user) {
                    return [
                        'gender' => $this->faker->randomElement(['male' ,'female']),
                        'age' => $this->faker->numberBetween(17, 45),
                        'user_id' => $user->id
                    ];
                })
        );
    }

    /**
     * Indicate that the user should have a admin.
     *
     * @return $this
     */
    public function withAdmin()
    {
        return $this->has(
            Admin::factory()
                ->state(function (array $attributes, User $user) {
                    return ['user_id' => $user->id];
                })
        );
    }

    /**
     * Indicate that the user should have a expert.
     *
     * @return $this
     */
    public function withExpert()
    {
        return $this->has(
            Expert::factory()
                ->state(function (array $attributes, User $user) {
                    return [
                        'position' => 'Psikolog',
                        'company' => 'Personal Growth',
                        'user_id' => $user->id
                    ];
                })
        );
    }

    /**
     * My Account
     *
     * @return $this
     */
    public function withDendyProfile()
    {
        return $this->has(
            UserProfile::factory()
                ->state(function (array $attributes, User $user) {
                    return [
                        'gender' => 'male',
                        'age' => 21,
                        'user_id' => $user->id
                    ];
                })
        );
    }
}
