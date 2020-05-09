<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;
use App\StoreItem;
use App\Cart;

class CartTest extends TestCase
{

    use RefreshDatabase;
    /**
     * @group only_authenticated_user_can_view_cart
     *
     * @return void
     */
    public function testOnlyAuthenticatedUserCanViewCart()
    {
        $response = $this->get('/cart');

        $response->assertRedirect('/login');
    }

    /**
     * @group only_authenticated_user_can_add_item_to_cart
     *
     * @return void
     */
    public function testOnlyAuthenticatedUserCanAddItemToCart()
    {

        // $this->withoutExceptionHandling();
        $this->withExceptionHandling();

        $user = factory(User::class)->create();
        $product = factory(StoreItem::class)->create();

        // dd($product);

        $this->actingAs($user);

        $response = $this->postJson('/cart/add', [
            'item_id' => $product->id,
            'quantity' => 1
        ]);

        $response->assertStatus(201);
    }
    
    /**
     * @group only_authenticated_user_can_delete_item_from_cart
     *
     * @return void
     */
    public function testOnlyAuthenticatedUserCanDeleteItemFromCart()
    {

        $this->withoutExceptionHandling();
        // $this->withExceptionHandling();

        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $item = factory(Cart::class)->create(['user_id' => $user->id]);
        $item2 = factory(Cart::class)->create(['user_id' => $user2->id]);

        // dd($product);

        $this->actingAs($user);
        // $this->actingAs($user2);

        $deleteItemResponse = $this->get(route('cart.delete', ['item'=>$item->id]));

        $deleteItemResponse->assertStatus(200);
    }
}
