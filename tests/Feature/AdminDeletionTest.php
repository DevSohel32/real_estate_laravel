<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Admin;
use App\Models\Agent;
use App\Models\Property;
use App\Models\Location;
use App\Models\Type;
use App\Models\Amenity;

class AdminDeletionTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin()
    {
        $admin = new Admin();
        $admin->name = 'Admin';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('password');
        $admin->save();
        return $admin;
    }

    private function createAgent()
    {
        $agent = new Agent();
        $agent->name = 'Agent';
        $agent->email = 'agent@example.com';
        $agent->password = bcrypt('secret');
        $agent->save();
        return $agent;
    }

    public function test_amenity_cannot_be_deleted_if_referenced_by_property()
    {
        $admin = $this->createAdmin();
        $agent = $this->createAgent();

        $amenity = new Amenity();
        $amenity->name = 'Pool';
        $amenity->save();

        $location = new Location();
        $location->name = 'Test Location';
        $location->save();

        $type = new Type();
        $type->name = 'Test Type';
        $type->save();

        $property = new Property();
        $property->agent_id = $agent->id;
        $property->location_id = $location->id;
        $property->type_id = $type->id;
        $property->name = 'Property 1';
        $property->slug = 'property-1';
        $property->price = 1000;
        $property->featured_photo = 'photo.jpg';
        $property->purpose = 'Sale';
        $property->bedroom = 2;
        $property->bathroom = 1;
        $property->size = 1200;
        $property->address = '123 Test St.';
        $property->is_featured = 'No';
        $property->status = 'Active';
        // Amenity controller checks by name in comma separated list
        $property->amenities = $amenity->name;
        $property->save();

        $response = $this->actingAs($admin, 'admin')
            ->delete(route('admin_amenity_deleted', $amenity->id));

        $response->assertRedirect(route('admin_amenity_index'));
        $response->assertSessionHas('error', 'Amenity cannot be deleted as it is associated with a property');

        $this->assertDatabaseHas('amenities', ['id' => $amenity->id]);
    }

    public function test_type_cannot_be_deleted_if_referenced_by_property()
    {
        $admin = $this->createAdmin();
        $agent = $this->createAgent();

        $type = new Type();
        $type->name = 'House';
        $type->save();

        $location = new Location();
        $location->name = 'Loc 2';
        $location->save();

        $property = new Property();
        $property->agent_id = $agent->id;
        $property->location_id = $location->id;
        $property->type_id = $type->id;
        $property->name = 'Property 2';
        $property->slug = 'property-2';
        $property->price = 2000;
        $property->featured_photo = 'photo2.jpg';
        $property->purpose = 'Rent';
        $property->bedroom = 3;
        $property->bathroom = 2;
        $property->size = 1500;
        $property->address = '456 Test Ave.';
        $property->is_featured = 'No';
        $property->status = 'Active';
        $property->save();

        $response = $this->actingAs($admin, 'admin')
            ->delete(route('admin_type_deleted', $type->id));

        $response->assertRedirect(route('admin_types_index'));
        $response->assertSessionHas('error', 'Cannot delete type. There are properties associated with it.');

        $this->assertDatabaseHas('types', ['id' => $type->id]);
    }

    public function test_location_cannot_be_deleted_if_referenced_by_property()
    {
        $admin = $this->createAdmin();
        $agent = $this->createAgent();

        $location = new Location();
        $location->name = 'Loc 3';
        $location->save();

        $type = new Type();
        $type->name = 'Apartment';
        $type->save();

        $property = new Property();
        $property->agent_id = $agent->id;
        $property->location_id = $location->id;
        $property->type_id = $type->id;
        $property->name = 'Property 3';
        $property->slug = 'property-3';
        $property->price = 3000;
        $property->featured_photo = 'photo3.jpg';
        $property->purpose = 'Sale';
        $property->bedroom = 4;
        $property->bathroom = 3;
        $property->size = 2500;
        $property->address = '789 Test Blvd.';
        $property->is_featured = 'No';
        $property->status = 'Active';
        $property->save();

        $response = $this->actingAs($admin, 'admin')
            ->delete(route('admin_location_deleted', $location->id));

        $response->assertRedirect(route('admin_locations_index'));
        $response->assertSessionHas('error', 'Cannot delete location. There are properties associated with it.');

        $this->assertDatabaseHas('locations', ['id' => $location->id]);
    }
}
