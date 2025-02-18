<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_task()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->post('/tasks', [
            'title' => 'Test Task',
        ]);
        
        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', ['title' => 'Test Task']);
    }

    public function test_user_can_view_tasks()
    {
        $user = User::factory()->create();
        Task::factory()->create(['title' => 'Sample Task', 'user_id' => $user->id]);
        
        $response = $this->actingAs($user)->get('/tasks');
        
        $response->assertStatus(200);
        $response->assertSee('Sample Task');
    }

    public function test_user_can_update_task()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['title' => 'Old Title', 'user_id' => $user->id]);
        
        $response = $this->actingAs($user)->put("/tasks/{$task->id}", [
            'title' => 'Updated Title',
        ]);
        
        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'title' => 'Updated Title']);
    }

    public function test_user_can_delete_task()
    {
        $user = User::factory()->create();
        $task = Task::factory()->create(['title' => 'Task to be deleted', 'user_id' => $user->id]);
        
        $response = $this->actingAs($user)->delete("/tasks/{$task->id}");
        
        $response->assertStatus(200);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
