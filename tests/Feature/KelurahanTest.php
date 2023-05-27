<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Kelurahan;

class KelurahanTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test get all kelurahans.
     *
     * @return void
     */
    public function testGetAllKelurahans()
    {
        // Membuat 3 kelurahan baru
        Kelurahan::factory()->count(3)->create();

        // Mengirim permintaan GET ke endpoint /kelurahans
        $response = $this->get('/kelurahans');

        // Memastikan response status adalah 200 (OK)
        $response->assertStatus(200);

        // Memastikan response memiliki jumlah data yang sesuai
        $response->assertJsonCount(3);
    }

    /**
     * Test create new kelurahan.
     *
     * @return void
     */
    public function testCreateNewKelurahan()
    {
        // Data kelurahan yang akan dibuat
        $kelurahanData = [
            'Nama_Kelurahan' => 'Kelurahan Test',
            'Nama_Kecamatan' => 'Kecamatan Test',
            'Nama_Kota' => 'Kota Test'
        ];

        // Mengirim permintaan POST ke endpoint /kelurahans dengan data kelurahan
        $response = $this->post('/kelurahans', $kelurahanData);

        // Memastikan response status adalah 201 (Created)
        $response->assertStatus(201);

        // Memastikan response memiliki data yang sesuai
        $response->assertJson($kelurahanData);

        // Memastikan kelurahan telah tersimpan dalam database
        $this->assertDatabaseHas('kelurahans', $kelurahanData);
    }

    /**
     * Test update kelurahan.
     *
     * @return void
     */
    public function testUpdateKelurahan()
    {
        // Membuat kelurahan baru
        $kelurahan = Kelurahan::factory()->create();

        // Data kelurahan yang akan diupdate
        $updatedKelurahanData = [
            'Nama_Kelurahan' => 'Kelurahan Test Updated',
            'Nama_Kecamatan' => 'Kecamatan Test Updated',
            'Nama_Kota' => 'Kota Test Updated'
        ];

        // Mengirim permintaan PUT ke endpoint /kelurahans/{id} dengan data kelurahan yang diupdate
        $response = $this->put('/kelurahans/' . $kelurahan->id, $updatedKelurahanData);

        // Memastikan response status adalah 200 (OK)
        $response->assertStatus(200);

        // Memastikan response memiliki data yang sesuai
        $response->assertJson($updatedKelurahanData);

        // Memastikan kelurahan telah diupdate dalam database
        $this->assertDatabaseHas('kelurahans', $updatedKelurahanData);
    }

    /**
     * Test delete kelurahan.
     *
     * @return void
     */
    public function testDeleteKelurahan()
    {
        // Membuat kelurahan baru
        $kelurahan = Kelurahan::factory()->create();

        // Mengirim permintaan DELETE ke endpoint /kelurahans/{id}
        $response = $this->delete('/kelurahans/' . $kelurahan->id);

        // Memastikan response status adalah 204 (No Content)
        $response->assertStatus(204);

        // Memastikan kelurahan telah dihapus dari database
        $this->assertDeleted($kelurahan);
    }
}
