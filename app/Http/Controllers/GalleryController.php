<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function show($id)
    {
        $images = [
            1 => ['src' => 'image/history/aparri-town-plaza.jpg', 'title' => 'APARRI TOWN PLAZA, CAGAYAN PROVINCE, 1935', 'description' => 'A bustling market, 1935.', 'source'=> 'UWM Libraries, AGSL Digital Photo Archive'],
            
            2 => ['src' => 'image/history/fishing-boat-unloading.jpg', 'title' => 'Fishing Boat Unloading -CA. 1900s-1930s', 'description' => 'This photograph captures the bustling activity of a fishing boat unloading its catch in Aparri, a prominent coastal town in Cagayan Province in northern Luzon. Taken during the early 20th century, the image reflects the vital role of the fishing industry in the livelihood of the local population.
            The boat in the photo is a traditional Filipino fishing vessel, likely equipped for deep-sea fishing. Several individuals can be seen unloading the boat haul, carefully handling the fish, which are abundant and freshly caught from the bountiful waters of the region. This task, performed manually, was an essential part of the local economy, supplying fish for both local consumption and trade.
            Aparri was known for its fertile fishing grounds and served as a hub for seafood trade. This photograph gives a glimpse of the labor-intensive nature of the work and highlights the craftsmanship and experience of the local fishing community. It also shows how fishing methods, largely dependent on human labor, sustained the people of the area long before the advent of modern, mechanized tools.
            This powerful historical image provides insight into the fishing culture of Aparri in the early 20th century, illustrating the tradition and hard work that supported the coastal economy during this period.', 'source'=> ' UMC Digital Galleries'],
            
            3 => ['src' => 'image/history/cockpit-arena.jpg', 'title' => 'COCKPIT, APARRI, CAGAYAN PROVINCE, ca.1900s-1930s', 'description' => '','source'=> 'herencia filipinas' ],
            
            4 => ['src' => 'image/history/aerial-view.jpg', 'title' => 'AERIAL VIEW: APARRI, CAGAYAN PROVINCE, 1923', 'description' => '','source'=> 'National Archives at College Park - Still Pictures' ],
            
            5 => ['src' => 'image/history/fish-net-and-poles.jpg', 'title' => 'FISHING NETS AND POLES, APARRI – CA. 1900S-1930s', 'description' => 'This historical photograph captures the traditional fishing tools used by the local fishing community in Aparri, Cagayan. Taken during the early 20th century, the image showcases a set of fishing nets and poles, essential equipment for catching fish in the coastal waters of the region.
            The fishing nets, often crafted by hand, are shown draped over poles, ready to be deployed into the water. The poles, typically made of bamboo or other locally available materials, are used to maneuver the nets and ensure that they are placed correctly to capture the fish. This manual fishing technique, which requires skill and patience, was the backbone of the fishing industry in Aparri, providing a sustainable livelihood for many families.
            Aparri, located at the mouth of the Cagayan River, was known for its rich fishing grounds, which attracted local fishermen who relied on these traditional methods for their daily catch. This photograph reflects the deep connection between the community and the sea, where fishing was not just an economic activity but a way of life.
            The image offers a glimpse into the fishing culture of the time, capturing the simple yet effective tools that have been passed down through generations, and showcases the importance of the sea as a source of food and livelihood for the people of Aparri.  ','source'=> ' UMC Digital Galleries' ],
            
            6 => ['src' => 'image/history/fisherman.jpg', 'title' => 'FISHERMANS AT APARRI, CAGAYAN PROVINCE, ca. 1900s-1910s', 'description' => '','source'=> 'herencia filipinas' ],
        ];

        if (!isset($images[$id])) {
            abort(404);
        }

        return view('guest.about-aparri.history.show', ['image' => $images[$id]]);
    }
}
