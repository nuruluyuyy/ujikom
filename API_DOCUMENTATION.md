# 📱 Gallery Sekolah API Documentation

## Base URL
```
http://127.0.0.1:8000/api/v1
```

## Response Format
All API responses follow this format:
```json
{
  "success": true,
  "message": "Success message",
  "data": {}
}
```

---

## 🖼️ Gallery Endpoints

### 1. Get All Galleries
**GET** `/galleries`

**Response:**
```json
{
  "success": true,
  "message": "Galleries retrieved successfully",
  "data": [
    {
      "id": 1,
      "title": "Foto Ijazah",
      "image": "galleries/photo.jpg",
      "category_id": 1,
      "created_at": "2025-10-09T12:00:00.000000Z",
      "category": {
        "id": 1,
        "name": "Lihat Detail"
      }
    }
  ]
}
```

### 2. Get Gallery Detail
**GET** `/galleries/{id}`

**Response:**
```json
{
  "success": true,
  "message": "Gallery retrieved successfully",
  "data": {
    "id": 1,
    "title": "Foto Ijazah",
    "image": "galleries/photo.jpg",
    "category": {...},
    "likes": [...],
    "comments": [...]
  }
}
```

### 3. Get Galleries by Category
**GET** `/galleries/category/{categoryId}`

**Response:** Same as Get All Galleries

### 4. Get All Categories
**GET** `/categories`

**Response:**
```json
{
  "success": true,
  "message": "Categories retrieved successfully",
  "data": [
    {
      "id": 1,
      "name": "Lihat Detail",
      "galleries_count": 5
    }
  ]
}
```

---

## 📰 News Endpoints

### 1. Get All News
**GET** `/news`

**Response:**
```json
{
  "success": true,
  "message": "News retrieved successfully",
  "data": [
    {
      "id": 1,
      "title": "SMKN 4 Bogor Raih Juara 1 LKS",
      "content": "Full content...",
      "image": "news/image.jpg",
      "slug": "smkn-4-bogor-raih-juara-1-lks",
      "category": "prestasi",
      "status": "published",
      "published_date": "2025-10-07"
    }
  ]
}
```

### 2. Get News Detail
**GET** `/news/{slug}`

**Response:** Single news object

### 3. Get News by Category
**GET** `/news/category/{category}`

Categories: `akademik`, `prestasi`, `kegiatan`, `pengumuman`

---

## 📅 Agenda Endpoints

### 1. Get All Agendas
**GET** `/agendas`

**Response:**
```json
{
  "success": true,
  "message": "Agendas retrieved successfully",
  "data": {
    "upcoming": [
      {
        "id": 1,
        "title": "Ujian Tengah Semester",
        "description": "Pelaksanaan UTS...",
        "start_date": "2025-10-15",
        "end_date": "2025-10-20",
        "start_time": "07:30",
        "end_time": "10:00",
        "location": "Ruang Kelas",
        "status": "upcoming"
      }
    ],
    "ongoing": []
  }
}
```

---

## 🧪 Test Endpoint

### Test API
**GET** `/test`

**Response:**
```json
{
  "success": true,
  "message": "API is working!",
  "version": "1.0.0"
}
```

---

## 📱 Mobile App Integration

### Flutter Example:
```dart
import 'package:http/http.dart' as http;
import 'dart:convert';

class ApiService {
  static const String baseUrl = 'http://127.0.0.1:8000/api/v1';
  
  Future<List<Gallery>> getGalleries() async {
    final response = await http.get(Uri.parse('$baseUrl/galleries'));
    
    if (response.statusCode == 200) {
      final data = json.decode(response.body);
      return (data['data'] as List)
          .map((json) => Gallery.fromJson(json))
          .toList();
    }
    throw Exception('Failed to load galleries');
  }
}
```

### React Native Example:
```javascript
const API_BASE_URL = 'http://127.0.0.1:8000/api/v1';

export const getGalleries = async () => {
  try {
    const response = await fetch(`${API_BASE_URL}/galleries`);
    const data = await response.json();
    return data.data;
  } catch (error) {
    console.error('Error fetching galleries:', error);
    throw error;
  }
};
```

---

## 🔒 Authentication (Coming Soon)
Future endpoints will require authentication using Laravel Sanctum.

---

## 📝 Notes
- All images are served from: `http://127.0.0.1:8000/storage/{path}`
- Replace `127.0.0.1:8000` with your production domain
- API versioning: `/api/v1/` (current version)
