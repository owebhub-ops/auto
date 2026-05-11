<?php
// app/Models/ContactMessageModel.php - MUST HAVE THIS
namespace App\Models;

use CodeIgniter\Model;

class ContactMessageModel extends Model
{
    protected $table = 'contact_messages';  // ✅ Exact table name
    protected $primaryKey = 'id';
    protected $allowedFields = [  // ❌ MISSING = NO INSERT!
        'name', 'email', 'subject', 'message', 
        'ip_address', 'user_agent', 'created_at'
    ]; 
    protected $useTimestamps = false;
    protected $returnType = 'array';

    // Test method
    public function testInsert()
    {
        return $this->insert([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'subject' => 'test',
            'message' => 'test message',
            'ip_address' => '127.0.0.1',
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
}