<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Category;
use App\Service;
use App\ServicePrice;
use Illuminate\Http\Request;

class ServiceController extends WebDriverController
{
    public function index()
    {
        $data['data'] = Service::select('id', 'name', 'created_id', 'category_id', 'created_at')->where('status', 1)->orderBy('created_at', 'DESC')->with('category:id,title')->with('created_user:id,name')->get();
        return view('service.index', $data);
    }

    public function create()
    {
        $data['categories'] = Category::select('id', 'title')->get()->toArray();
        return view('service.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'summary' => 'required|string',
//            'content' => 'required|string',
            'category' => 'required|integer|exists:categories,id',
            'avatar' => 'required|image|max:5120',
            'background' => 'required|image|max:5120',
            'service_price' => 'required|array',
            'service_price.*' => 'required|array',
            'images' => 'required|array',
            'images.*' => 'required|image|max:5120'
        ]);

        $cities = null;
        $districts = null;

        if($request->has('cities') && !empty($request->cities)) {
            $cities = $request->cities;
        }

        if($request->has('districts') && !empty($request->districts)) {
            $districts = $request->districts;
        }

        $fileAvatar = $request->avatar;

        $avatar = str_replace(" ", "", time() . '_' . $fileAvatar->getClientOriginalName());

        $fileAvatar->move('uploads', $avatar);

        $fileBackground = $request->background;

        $background = str_replace(" ", "", time() . '_' . $fileBackground->getClientOriginalName());

        $fileBackground->move('uploads', $background);

        $images = [];

        if ($request->images) {
            foreach ($request->images as $index => $image) {
                $fileName = str_replace(" ", "", time() . '_' . $image->getClientOriginalName());
                $image->move('uploads/', $fileName);
                $images[] = $fileName;
            }
        }

        $service = new Service([
            'name' => $request->name,
            'summary' => $request->summary,
//            'content' => $request->get('content'),
            'category_id' => $request->category,
            'status' => 1,
            'created_at' => now(),
            'created_id' => auth()->user()->id,
            'avatar' => $avatar,
            'background' => $background,
            'images' => json_encode($images),
            'cities' => json_encode($cities),
            'districts' => json_encode($districts)
        ]);

        $service->save();

        $serviceId = $service->id;

        $servicePrices = [];

        foreach ($request->service_price['name'] as $index => $serviceName) {
            $fileName = null;
            $servicePriceOnline = isset($request->service_price['price_online'][$index]) ? $request->service_price['price_online'][$index] : null;
            $servicePriceOnlineType = isset($request->service_price['price_online_type'][$index]) ? $request->service_price['price_online_type'][$index] : null;
            $servicePriceOffline = isset($request->service_price['price_offline'][$index]) ? $request->service_price['price_offline'][$index] : null;
            $servicePriceOfflineType = isset($request->service_price['price_offline_type'][$index]) ? $request->service_price['price_offline_type'][$index] : null;
            $servicePriceContent = isset($request->service_price['content'][$index]) ? $request->service_price['content'][$index] : null;
            $servicePriceAvatar = isset($request->service_price['avatar'][$index]) ? $request->service_price['avatar'][$index] : null;
            if ($servicePriceAvatar) {
                $fileName = str_replace(" ", "", time() . '_' . $servicePriceAvatar->getClientOriginalName());
                $servicePriceAvatar->move('uploads/', $fileName);
            }
            if ($serviceName) {
                $servicePrices[] = [
                    'avatar' => $fileName,
                    'name' => $serviceName,
                    'price_online' => ($servicePriceOnlineType == 'deal') ? null : $servicePriceOnline,
                    'price_online_type' => $servicePriceOnlineType,
                    'price_offline' => ($servicePriceOfflineType == 'deal') ? null : $servicePriceOffline,
                    'price_offline_type' => $servicePriceOfflineType,
                    'content' => $servicePriceContent,
                    'created_at' => now(),
                    'created_id' => auth()->user()->id,
                    'status' => 1,
                    'service_id' => $serviceId
                ];
            }
        }

        ServicePrice::insert($servicePrices);

        return redirect()->route('admin.service.index');
    }

    public function edit($id)
    {
        if (!$id) return redirect()->route('admin.service.index');
        $data['data'] = Service::with('service_prices')->findOrFail($id)->toArray();
        $data['categories'] = Category::select('id', 'title')->get()->toArray();
        return view('service.edit', $data);
    }

    public function delete(Request $request, $id = null)
    {
        if ($request->ajax()) {
            $request->validate([
                'id' => 'required|array',
                'id.*' => 'required|integer|exists:services,id'
            ]);

            if ($request->id) {
                foreach ($request->id as $id) {
                    Service::where('id', $id)->update([
                        'status' => 0
                    ]);
                }
            }

            return response()->json(true);
        }
        if ($id) {
            $instance = Service::where('id', $id);
            if (!$instance->exists()) return redirect()->route('admin.service.index');
            $instance->update([
                'status' => 0
            ]);
            return redirect()->route('admin.service.index')->with('success', 'Xoá thành công !');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'summary' => 'required|string',
//            'content' => 'required|string',
            'category' => 'required|integer|exists:categories,id',
            'avatar' => 'image|max:5120',
            'background' => 'image|max:5120',
            'service_price' => 'required|array',
            'service_price.*' => 'required|array',
            'images' => 'nullable|array',
            'images.*' => 'required|image|max:5120'
        ]);

        $instance = Service::where('id', $id);

        if (!$instance->exists()) redirect()->route('admin.service.index');

        $update = [
            'name' => $request->name,
            'summary' => $request->summary,
//            'content' => $request->get('content'),
            'category_id' => $request->category,
            'status' => 1,
            'updated_at' => now(),
            'updated_id' => auth()->user()->id
        ];

        if ($request->hasFile('avatar')) {
            $fileAvatar = $request->avatar;

            $avatar = str_replace(" ", "", time() . '_' . $fileAvatar->getClientOriginalName());

            $fileAvatar->move('uploads', $avatar);

            $update['avatar'] = $avatar;
        }

        if ($request->hasFile('background')) {
            $fileBackground = $request->background;

            $background = str_replace(" ", "", time() . '_' . $fileBackground->getClientOriginalName());

            $fileBackground->move('uploads', $background);

            $update['background'] = $background;
        }

        $images = $request->images_old;

        if ($request->images) {
            foreach ($request->images as $index => $image) {
                $fileName = str_replace(" ","",time() . '_' . $image->getClientOriginalName());
                $image->move('uploads/', $fileName);
                $images[] = $fileName;
            }
        }

        $update['images'] = json_encode($images);

        $service = $instance->update($update);

        ServicePrice::where('service_id', $id)->update([
            'status' => 0
        ]);

        $servicePrices = [];

        foreach ($request->service_price['name'] as $index => $serviceName) {
            //
            $fileName = isset($request->service_price['avatar_old'][$index]) ? $request->service_price['avatar_old'][$index] : null;;
            $servicePriceOnline = isset($request->service_price['price_online'][$index]) ? $request->service_price['price_online'][$index] : null;
            $servicePriceOnlineType = isset($request->service_price['price_online_type'][$index]) ? $request->service_price['price_online_type'][$index] : null;
            $servicePriceOffline = isset($request->service_price['price_offline'][$index]) ? $request->service_price['price_offline'][$index] : null;
            $servicePriceOfflineType = isset($request->service_price['price_offline_type'][$index]) ? $request->service_price['price_offline_type'][$index] : null;
            $servicePriceContent = isset($request->service_price['content'][$index]) ? $request->service_price['content'][$index] : null;
            $servicePriceAvatar = isset($request->service_price['avatar'][$index]) ? $request->service_price['avatar'][$index] : null;
            if ($servicePriceAvatar) {
                $fileName = str_replace(" ","",time() . '_' . $servicePriceAvatar->getClientOriginalName());
                $servicePriceAvatar->move('uploads/', $fileName);
            }
            if ($serviceName) {
                $servicePrices[] = [
                    'avatar' => $fileName,
                    'name' => $serviceName,
                    'price_online' => $servicePriceOnline,
                    'price_online_type' => $servicePriceOnlineType,
                    'price_offline' => $servicePriceOffline,
                    'price_offline_type' => $servicePriceOfflineType,
                    'content' => $servicePriceContent,
                    'created_at' => now(),
                    'created_id' => auth()->user()->id,
                    'status' => 1,
                    'service_id' => $id
                ];
            }
        }

        ServicePrice::insert($servicePrices);

        return redirect()->route('admin.service.edit', ['id' => $id]);
    }
}
