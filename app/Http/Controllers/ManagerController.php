<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
      // Get all managers
      public function index()
      {
          $managers = Manager::all();
  
          return response()->json($managers);
      }
  
      // Create a new manager
      public function store(Request $request)
      {
          // Validate the request data
          $validatedData = $request->validate([
              'name' => 'required',
              'email' => 'required|email|unique:users',
              'password' => 'required|min:6',
              'role' => 'required|in:' . implode(',', array_keys(Manager::$roleOptions)),
          ]);
  
          // Create the manager
          $manager = Manager::create($validatedData);
  
          return response()->json($manager, 201);
      }
  
      // Get a specific manager
      public function show(Manager $manager)
      {
          return response()->json($manager);
      }
  
      // Update a manager
      public function update(Request $request, Manager $manager)
      {
          // Validate the request data
          $validatedData = $request->validate([
              'name' => 'required',
              'email' => 'required|email|unique:users,email,' . $manager->id,
              'password' => 'nullable|min:6',
              'role' => 'required|in:' . implode(',', array_keys(Manager::$roleOptions)),
          ]);
  
          // Update the manager
          $manager->update($validatedData);
  
          return response()->json($manager);
      }
  
      // Delete a manager
      public function destroy(Manager $manager)
      {
          $manager->delete();
  
          return response()->json(null, 204);
      }
}
